package com.dwiki.satusehat.ui

import android.content.Intent
import android.content.SharedPreferences
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.Handler
import android.os.Looper
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.ActivitySplashBinding
import com.dwiki.satusehat.viewModel.StateViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class SplashActivity : AppCompatActivity() {

    private lateinit var binding: ActivitySplashBinding
    private val stateViewModel:StateViewModel by viewModels()
    private lateinit var pref: SharedPreferences


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivitySplashBinding.inflate(layoutInflater)
        setContentView(binding.root)
        //setup status bar
        window.statusBarColor = ContextCompat.getColor(this, R.color.white)
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)

        Handler(Looper.getMainLooper()).postDelayed({
            getLoginState()
        },3000)

    }

    private fun getLoginState() {
        val token  = pref.getString("key_token","KOSONG")
//        stateViewModel.getLoginState().observe(this) {
//            if (it) {
//                startActivity(Intent(this, DashboardActivity::class.java))
//                finish()
//            } else {
//                startActivity(Intent(this, LoginActivity::class.java))
//                finish()
//            }
//        }
            if (token != "KOSONG") {
                startActivity(Intent(this, DashboardActivity::class.java))
                finish()
            } else {
                startActivity(Intent(this, LoginActivity::class.java))
                finish()
            }
        }

    }