package com.dwiki.satusehat.ui

import android.content.Intent
import android.graphics.Color
import android.graphics.drawable.ColorDrawable
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.ActivityPendaftaranRumahSakitBinding


class PendaftaranRumahSakitActivity : AppCompatActivity() {

    private lateinit var binding:ActivityPendaftaranRumahSakitBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityPendaftaranRumahSakitBinding.inflate(layoutInflater)
        setContentView(binding.root)

        window.statusBarColor = ContextCompat.getColor(this,R.color.white)
        supportActionBar?.title = "Pilih rumah sakit"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this,R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

    }

    override fun onSupportNavigateUp(): Boolean {
        val intent = Intent(this, DashboardActivity::class.java)
        startActivity(intent)
        return true
    }
}