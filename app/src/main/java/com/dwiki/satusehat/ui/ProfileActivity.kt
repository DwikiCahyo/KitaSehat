package com.dwiki.satusehat.ui

import android.content.Intent
import android.content.SharedPreferences
import android.graphics.drawable.ColorDrawable
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.ActivityProfileBinding
import com.dwiki.satusehat.viewModel.PasienProfileViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class ProfileActivity : AppCompatActivity() {

    private lateinit var binding:ActivityProfileBinding
    private lateinit var pref: SharedPreferences

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityProfileBinding.inflate(layoutInflater)
        setContentView(binding.root)
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)

        //setup for action bar
        window.statusBarColor = ContextCompat.getColor(this,R.color.white)
        supportActionBar?.title = "Akun User"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this,R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

        logout()
        editProfile()
    }

    private fun editProfile() {
        binding.layoutUbahProfil.setOnClickListener {
            val intent = Intent(this,EditProfileActivity::class.java)
            startActivity(intent)
        }
    }

    private fun logout() {
        binding.layoutKeluar.setOnClickListener {
            val editor = pref.edit()
            editor.clear()
            editor.apply()
            val intent = Intent(this,LoginActivity::class.java)
            startActivity(intent)
            finish()

        }
    }
}