package com.dwiki.satusehat.ui

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.Handler
import android.view.View
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.MainActivity
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.ActivitySplashBinding
import com.dwiki.satusehat.viewModel.StateViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class SplashActivity : AppCompatActivity() {

    private lateinit var binding: ActivitySplashBinding
    private val stateViewModel:StateViewModel by viewModels()


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivitySplashBinding.inflate(layoutInflater)
        setContentView(binding.root)
        //setup status bar
        window.statusBarColor = ContextCompat.getColor(this, R.color.white)

        Handler().postDelayed({
            getLoginState()
        },2000)

    }

    private fun getLoginState() {
        stateViewModel.getLoginState().observe(this) {
            if (it) {
                startActivity(Intent(this, DashboardActivity::class.java))
                finish()
            } else {
                startActivity(Intent(this, LoginActivity::class.java))
                finish()
            }
        }
    }
}