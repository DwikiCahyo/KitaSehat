package com.dwiki.satusehat.ui

import android.content.SharedPreferences
import android.graphics.drawable.ColorDrawable
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.ActivityTambahKontakDaruratBinding
import com.dwiki.satusehat.ui.dialog.SuccessDialog
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewModel.PasienProfileViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class TambahKontakDaruratActivity : AppCompatActivity() {

    private lateinit var binding:ActivityTambahKontakDaruratBinding
    private lateinit var pref: SharedPreferences
    private val pasienProfileViewModel:PasienProfileViewModel by viewModels()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityTambahKontakDaruratBinding.inflate(layoutInflater)
        setContentView(binding.root)

        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token = pref.getString("key_token","KOSONG")!!

        window.statusBarColor = ContextCompat.getColor(this,R.color.white)
        supportActionBar?.title = "Edit Profile"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this,R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

        binding.btnSimpanData.setOnClickListener {
            addKontakDarurat(token)
        }

    }

    private fun addKontakDarurat(token:String) {
        val nama = binding.edtNama.text.toString()
        val noTelpon = "+62" + binding.edtNoTelepon.text.toString()

        pasienProfileViewModel.postKontakDarurat(token,nama,noTelpon)
        pasienProfileViewModel.responseItemKontakDarurat.observe(this){
            when(it.status){
                Status.SUCCESS ->{
                    SuccessDialog("Berhasil Menambahkan Kontak Darurat").show(supportFragmentManager,"succes")
                }
                Status.LOADING ->{
                    Log.d("TambahKontakDarurat","loading")
                }
                Status.ERROR ->{
                    Log.e("TambahKontakDarurat","error")
                }
            }
        }
    }
}