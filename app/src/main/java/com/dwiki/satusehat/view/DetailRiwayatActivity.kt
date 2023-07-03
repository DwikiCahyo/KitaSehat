package com.dwiki.satusehat.view

import android.content.SharedPreferences
import android.graphics.drawable.ColorDrawable
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.ActivityDetailRiwayatBinding
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewmodel.DetailRiwayatViewModel
import com.dwiki.satusehat.viewmodel.PasienProfileViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class DetailRiwayatActivity : AppCompatActivity() {

    private lateinit var binding:ActivityDetailRiwayatBinding
    private lateinit var pref: SharedPreferences
    private val profileViewModel: PasienProfileViewModel by viewModels()
    private val detailViewModel: DetailRiwayatViewModel by viewModels()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding  = ActivityDetailRiwayatBinding.inflate(layoutInflater)
        setContentView(binding.root)
        //setup for action bar
        window.statusBarColor = ContextCompat.getColor(this,R.color.white)
        supportActionBar?.title = "Detail"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this,R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

        //get token
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token  = pref.getString("key_token","KOSONG")

        //get id
        val bundle = intent.extras
        val idRiwayat = bundle?.getInt("id")
        val jenisRiwayat = bundle?.getString("jenis")

        if (jenisRiwayat == "BPJS")  getDetailRiwayatBpjs(token!!,idRiwayat!!) else getDetailRiwayatUmum(token!!,idRiwayat!!)

        if (token != null) {
            getProfilePasien(token)
        }




    }

    private fun getDetailRiwayatUmum(token: String, idRiwayat: Int) {
        detailViewModel.getDetailRiwayatUmum(token, idRiwayat)
        detailViewModel.responseDetailRiwayatUmum.observe(this) { detailUmum ->
            when (detailUmum.status) {
                Status.SUCCESS -> {
                    val detailResponse = detailUmum.data
                    if (detailResponse != null) {
                        binding.tvJenisLayanan.text = "Umum"
                        binding.ivIconLayanan.setImageResource(R.drawable.ic_umum)
                        binding.tvStatusLayanan.text = "Status : ${detailResponse.status}"
                        binding.tvRumahSakit.text = detailResponse.rumahSakitRumahSakit
                        binding.tvFasilitas.text = detailResponse.fasilitasLayanan
                        binding.tvTanggal.text = detailResponse.waktu.substring(0, 10)
                        binding.tvKeluhan.text = detailResponse.keluhanAwal
                    }
                }
                Status.LOADING -> {
                    Log.d(TAG, "Loading")
                }
                Status.ERROR -> {
                    if (token != null) {
                        Log.e(TAG, "Error : $token jancokkkkk ")
                    } else {
                        Log.e(TAG, "Error : Tidak ada token")
                    }
                }
            }

        }
    }

    private fun getDetailRiwayatBpjs(token: String, id:Int) {
        detailViewModel.getDetailRiwayatBpjs(token,id)
        detailViewModel.responseDetailRiwayatBPJs.observe(this){ detailBpjs ->
            when(detailBpjs.status){
                Status.SUCCESS ->{
                    val detailResponse = detailBpjs.data
                    if (detailResponse != null){
                        binding.tvJenisLayanan.text = "BPJS"
                        binding.ivIconLayanan.setImageResource(R.drawable.ic_bpjs)
                        binding.tvStatusLayanan.text = "Status : ${detailResponse.status}"
                        binding.tvRumahSakit.text = detailResponse.rumahSakitRumahSakit
                        binding.tvFasilitas.text = detailResponse.fasilitasLayanan
                        binding.tvTanggal.text = detailResponse.waktu.substring(0,10)
                        binding.tvKeluhan.text = detailResponse.keluhanAwal
                    }
                }
                Status.LOADING ->{
                    Log.d(TAG, "Loading")
                }
                Status.ERROR ->{
                    if (token != null){
                        Log.e(TAG, "Error : $token ")
                    } else {
                        Log.e(TAG, "Error : Tidak ada token")
                    }
                }
            }

        }
    }

    private fun getProfilePasien(token: String) {
        profileViewModel.getProfile(token).observe(this) { profile ->
            when (profile.status) {
                Status.SUCCESS -> {
                    val profileResponse = profile.data
                    if (profileResponse != null) {
                        Log.d(TAG, "message : ${profileResponse.message}")
                        Log.d(TAG, "message : ${profileResponse.dataPasien.nama}")
                        Log.d(TAG,"token : $token"  )
                        Log.d(TAG,"all response:  ${profileResponse.dataPasien}")
                        binding.tvNamaPasien.text = profileResponse.dataPasien.nama
                        binding.tvNik.text = profileResponse.dataPasien.nik
                        binding.tvTtl.text = profileResponse.dataPasien.tanggalLahir
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

    companion object {
        const val TAG = "DetailRiwayatActivity"
    }
}