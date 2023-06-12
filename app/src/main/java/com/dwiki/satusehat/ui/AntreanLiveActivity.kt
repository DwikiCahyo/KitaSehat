package com.dwiki.satusehat.ui

import android.content.Intent
import android.content.SharedPreferences
import android.graphics.drawable.ColorDrawable
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.provider.AlarmClock
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.ActivityAntreanLiveBinding
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewModel.StatusAntreanViewModel
import dagger.hilt.android.AndroidEntryPoint
import kotlinx.coroutines.flow.observeOn

@AndroidEntryPoint
class AntreanLiveActivity : AppCompatActivity() {

    private lateinit var binding:ActivityAntreanLiveBinding
    private lateinit var pref: SharedPreferences
    private val statusAntreanViewModel:StatusAntreanViewModel by viewModels()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityAntreanLiveBinding.inflate(layoutInflater)
        setContentView(binding.root)

        window.statusBarColor = ContextCompat.getColor(this,R.color.white)
        supportActionBar?.title = "Detail Antrean "
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this,R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

        //init token
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token  = pref.getString("key_token","KOSONG")

        getAntreanLive(token)
        binding.btnRefresh.setOnClickListener {
            val intent = Intent(this, AntreanLiveActivity::class.java)
            startActivity(intent)
            finish()
        }


        binding.btnBatalkan.setOnClickListener {
            val intent = Intent(AlarmClock.ACTION_SET_ALARM)
            intent.putExtra(AlarmClock.EXTRA_MESSAGE,"Silahkan Menuju Layanan Anda")
            intent.putExtra(AlarmClock.EXTRA_HOUR, 0)
            intent.putExtra(AlarmClock.EXTRA_MINUTES, 1)
            startActivity(intent)
        }


    }

    private fun getAntreanLive(token: String?) {
        statusAntreanViewModel.getStatusAntrean(token!!).observe(this){
            when (it.status){
                Status.LOADING ->{
                    Log.d(TAG, "Loading")
                    binding.layoutNoLoginCart.visibility = View.VISIBLE
                    binding.layoutDetail.visibility = View.GONE
                }
                Status.SUCCESS ->{
                    binding.layoutNoLoginCart.visibility = View.GONE
                    binding.layoutDetail.visibility = View.VISIBLE

                    val jenisPasien = it.data?.data?.jenisPasien
                    if (jenisPasien == "UMUM"){
                        binding.ivIconLayanan.setImageResource(R.drawable.ic_umum)
                        binding.tvJenisLayanan.text = "UMUM"
                    } else{
                        binding.ivIconLayanan.setImageResource(R.drawable.ic_bpjs)
                        binding.tvJenisLayanan.text = "BPJS"
                    }
                    binding.tvTanggalPendaftraan.text = "Tanggal Pendaftaran : " + it.data?.data?.tanggalPendaftaran
                    binding.tvWaktuPendaftaraan.text = "Waktu Pendaftaraan : " + it.data?.data?.waktuPendaftaran
                    binding.antreanSaatIni.text = it.data?.data?.noAntreanSaatIni.toString()
                    binding.antreanAnda.text = it.data?.data?.nomorAntrean.toString()
                    binding.tvFasilitas.text = it.data?.data?.fasilitas
                    binding.tvRumahSakit.text = it.data?.data?.rumahSakit
                }
                Status.ERROR ->{

                    binding.layoutNoLoginCart.visibility = View.GONE
                    binding.layoutDetail.visibility = View.GONE
                    if (token != null){
                        Log.e(DetailRiwayatActivity.TAG, "Error : $token jancokkkkk ")
                    } else {
                        Log.e(DetailRiwayatActivity.TAG, "Error : Tidak ada token")
                    }
                }
            }
        }
    }

    companion object{
        const val TAG = "AntreanLiveActivity"
    }
}