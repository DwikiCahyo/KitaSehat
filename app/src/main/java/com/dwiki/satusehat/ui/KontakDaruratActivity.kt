package com.dwiki.satusehat.ui

import android.content.Intent
import android.content.SharedPreferences
import android.graphics.drawable.ColorDrawable
import android.net.Uri
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.dwiki.satusehat.R
import com.dwiki.satusehat.adapter.KontakDaruratAdapter
import com.dwiki.satusehat.databinding.ActivityKontakDaruratBinding
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewModel.PasienProfileViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class KontakDaruratActivity : AppCompatActivity() {

    private lateinit var binding: ActivityKontakDaruratBinding
    private lateinit var kontakAdapter:KontakDaruratAdapter
    private val pasienProfileViewModel:PasienProfileViewModel by viewModels()
    private lateinit var pref: SharedPreferences

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityKontakDaruratBinding.inflate(layoutInflater)
        setContentView(binding.root)

        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token = pref.getString("key_token","KOSONG")!!

        //setup for action bar
        window.statusBarColor = ContextCompat.getColor(this,R.color.white)
        supportActionBar?.title = "Kontak Darurat"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this,R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

        setupListKontak(token)

        binding.btnTambahKontak.setOnClickListener {
            val intent = Intent(this, TambahKontakDaruratActivity::class.java)
            startActivity(intent)
        }
    }

    private fun setupListKontak(token:String) {
        pasienProfileViewModel.getKontakDarurat(token)
        pasienProfileViewModel.responseKontakDarurat.observe(this){ kontakDarurat ->
            when(kontakDarurat.status){
                Status.SUCCESS -> {
                    binding.rvKontakDarurat.apply {
                        layoutManager = LinearLayoutManager(this@KontakDaruratActivity,RecyclerView.VERTICAL,false)
                        kontakAdapter = KontakDaruratAdapter(kontakDarurat.data?.listKontakDarurat ?: emptyList()){
                            val intent = Intent(Intent.ACTION_DIAL)
                            intent.data = Uri.parse("tel:${it.noHp}")
                            startActivity(intent)
                        }
                        adapter = kontakAdapter
                    }
                }
                Status.LOADING ->{
                    Log.d("KontakDaruratActivity","loading")
                }
                Status.ERROR ->{
                    Log.e("KontakDaruratActivity","error")
                }
            }

        }
    }
}