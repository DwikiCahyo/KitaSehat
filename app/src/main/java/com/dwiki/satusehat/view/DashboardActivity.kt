package com.dwiki.satusehat.view

import android.content.Intent
import android.content.SharedPreferences
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.view.View
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import com.bumptech.glide.Glide
import com.denzcoskun.imageslider.constants.ScaleTypes
import com.denzcoskun.imageslider.models.SlideModel
import com.dwiki.satusehat.PreferenceManager
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.DashboardActivityBinding
import com.dwiki.satusehat.view.dialog.DialogAlreadyRegister
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewmodel.PasienProfileViewModel
import com.dwiki.satusehat.viewmodel.SliderViewModel
import com.dwiki.satusehat.viewmodel.StateViewModel
import com.dwiki.satusehat.viewmodel.StatusAntreanViewModel
import dagger.hilt.android.AndroidEntryPoint
import javax.inject.Inject

@AndroidEntryPoint
class DashboardActivity : AppCompatActivity()  {

    private lateinit var binding: DashboardActivityBinding
    private val stateViewModel:StateViewModel by viewModels()
    //viewmodel for profile
    private val profileViewModel:PasienProfileViewModel by viewModels()
    //viewmodel for status antrean
    private val statusAntreanViewModel:StatusAntreanViewModel by viewModels()
    private val sliderViewModel:SliderViewModel by viewModels()

    private var isLogin  = false
    private lateinit var loadingDialog: LoadingDialog
    private lateinit var pref: SharedPreferences
    @Inject lateinit var prefManager:PreferenceManager



    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = DashboardActivityBinding.inflate(layoutInflater)
        setContentView(binding.root)
        Log.d(TAG,"On Create")

        //init pref
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token  = pref.getString("key_token","KOSONG")
        if (token != null) {
            getProfilePasien(token)
        }


        //setup for loading
        loadingDialog = LoadingDialog(this)

        //setup status bar
        window.statusBarColor = ContextCompat.getColor(this, R.color.primary)

        prefManager.getToken()


        binding.ivProfilePasien.setOnClickListener {
            val intent = Intent(this,ProfileActivity::class.java)
            startActivity(intent)
        }

       //set click for card number 2 in dashboard
        binding.cvLayanan2.setOnClickListener {
            val intent = Intent(this,DetailRumahSakitActivity::class.java)
            startActivity(intent)
        }

        binding.cvLayanan3.setOnClickListener {
            val intent = Intent(this,RiwayatPendaftaranActivity::class.java)
            startActivity(intent)
        }


        imaageSlider()

        //set opactiy for text color
        binding.tvSelamatDatang.alpha = 0.75f


    }

    private fun imaageSlider() {
        val imageSlider = binding.imageSlider
        val sliderItem = ArrayList<SlideModel>()

        sliderViewModel.imageSlider()
        sliderViewModel.getImageSlider.observe(this){
            it.map { sliderItem.add(SlideModel(it.imageLink)) }
            imageSlider.setImageList(sliderItem,ScaleTypes.CENTER_CROP)
        }


    }

    private fun getStatusAntrean(token: String){
        statusAntreanViewModel.getStatusAntrean(token).observe(this){ antrean ->
            when(antrean.status){
                Status.SUCCESS -> {
                    val antreanResponse = antrean.data
                    if (antreanResponse != null){
                        isRegister(true)
                        binding.layoutLayanan4.visibility = View.VISIBLE
                        Log.d(TAG, "message : ${antreanResponse.message}")
                        val dataAntrean = antreanResponse.data
                        //binding for card antrean
                        binding.tvStatusAntrian.text = "Status antrean anda"
                        binding.tvNoAntrean.text = dataAntrean.nomorAntrean.toString()
                        binding.tvRumahSakit.text = dataAntrean.rumahSakit.toString()
                        binding.tvFasilitasRs.text = dataAntrean.fasilitas.toString()
                        if (dataAntrean.jenisPasien == "BPJS"){
                            binding.tvJenisAntrean.visibility = View.VISIBLE
                            binding.tvJenisAntrean.text = "BPJS"
                        } else{
                            binding.tvJenisAntrean.visibility = View.VISIBLE
                            binding.tvJenisAntrean.text = "Umum"
                        }
                        //setting for shimmer
                        binding.antreanPasien.visibility = View.VISIBLE
                        binding.icDestination.visibility = View.VISIBLE
                        binding.icFasilitas.visibility = View.VISIBLE
                        binding.shimmerFrameLayout.stopShimmer()
                        binding.shimmerFrameLayout.visibility = View.GONE
                    }
                }
                Status.LOADING ->{
                    binding.antreanPasien.visibility = View.INVISIBLE
                    binding.shimmerFrameLayout.startShimmer()
                    Log.d(TAG, "Loading")
                }
                Status.ERROR -> {
                    isRegister(false)
                    binding.antreanPasien.visibility = View.VISIBLE
                    binding.tvStatusAntrian.text = "Anda Belum Terdaftar"
                    binding.tvRumahSakit.text ="Silahkan mendaftar"
                    binding.tvNoAntrean.text = "i"
                    binding.tvFasilitasRs.visibility = View.GONE
                    binding.icDestination.visibility = View.GONE
                    binding.icFasilitas.visibility = View.GONE
                    binding.shimmerFrameLayout.visibility = View.GONE
                    Log.e(TAG, "Error : ${antrean.message}")
                }
            }

        }
    }


    private fun getProfilePasien(token:String) {
            profileViewModel.getProfile(token).observe(this) { profile ->
                when (profile.status) {
                    Status.SUCCESS -> {
                        val profileResponse = profile.data
                        if (profileResponse != null) {
                            Log.d(TAG, "message : ${profileResponse.message}")
                            Log.d(TAG, "message : ${profileResponse.dataPasien.nama}")
                            Log.d(TAG,"token : $token"  )
                            Log.d(TAG,"all response:  ${profileResponse.dataPasien}")

                            val dataPasien = profileResponse.dataPasien
//                            binding.tvSelamatDatang.text = getString(R.string.selamat_datang, dataPasien.nama)
                            binding.tvSelamatDatang.text = "Selamat Datang,\n${dataPasien.nama}"
                            if (dataPasien.fotoProfil == null){
                                binding.ivProfilePasien.setImageResource(R.drawable.ic_default_profile)
                            } else{
                                Glide.with(this).load(dataPasien.fotoProfil).fitCenter().into(binding.ivProfilePasien)
                            }

                        }
                    }
                    Status.LOADING -> {
                        Log.d(TAG, "Loading")
                    }

                    Status.ERROR -> {
                        if (token != null){
                            Log.e(TAG, "Error : $token jancokkkkk ")
                        } else {
                            Log.e(TAG, "Error : Tidak ada token")
                        }
                    }
                }
            }
    }

    private fun isRegister(isRegister:Boolean){
        if (isRegister){
            binding.cvLayanan1.setOnClickListener {
                DialogAlreadyRegister("Anda sudah terdaftar dalam antrean").show(supportFragmentManager,"DialogAlreadyRegister")
            }
            binding.cvLayanan4.setOnClickListener {
                val intent  = Intent(this,AntreanLiveActivity::class.java)
                startActivity(intent)
            }
        } else{
            binding.cvLayanan1.setOnClickListener {
                val intent = Intent(this,PendaftaranRumahSakitActivity::class.java)
                startActivity(intent)
            }
            binding.cvLayanan4.setOnClickListener {
                DialogAlreadyRegister("Anda belum terdaftar dalam antrean").show(supportFragmentManager,"DialogAlreadyRegister")
            }
        }

    }

    override fun onResume() {
        super.onResume()
        Log.d(TAG,"on Resume")
        binding.shimmerFrameLayout.visibility = View.VISIBLE
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token  = pref.getString("key_token","KOSONG")
        if (token != null) {
            getStatusAntrean(token)
        }
    }

    companion object {
        const val TAG = "DashboardActivity"
    }
}