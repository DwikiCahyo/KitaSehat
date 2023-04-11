package com.dwiki.satusehat.ui

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.DashboardActivityBinding
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewModel.PasienProfileViewModel
import com.dwiki.satusehat.viewModel.StateViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class DashboardActivity : AppCompatActivity() {

    private lateinit var binding: DashboardActivityBinding
    private val stateViewModel:StateViewModel by viewModels()
    private val profileViewModel:PasienProfileViewModel by viewModels()
    private var isLogin  = false
    private lateinit var loadingDialog: LoadingDialog


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = DashboardActivityBinding.inflate(layoutInflater)
        setContentView(binding.root)


        //setup for loading
        loadingDialog = LoadingDialog(this)

        //setup status bar
        window.statusBarColor = ContextCompat.getColor(this, R.color.white)


        //get token value
        stateViewModel.getToken().observe( this) { it ->
//            val token = it
            getProfilePasien(it)
            binding.tvToken.text = it

        }

        //get state value
        stateViewModel.getLoginState().observe(this) {
            isLogin = it
            binding.tvState.text = if (isLogin) "Login" else "Logout"
        }

//        if (token != null) {
//            profileViewModel.getProfile(token).observe(this) { profile ->
//                when (profile.status) {
//                    Status.LOADING -> {
//                        loadingDialog.startLoading()
//                        Log.d(TAG, "Loading")
//                    }
//                    Status.SUCCESS -> {
//                        loadingDialog.dismissDialog()
//                        val profileResponse = profile.data
//                        if (profileResponse != null) {
//                            Log.d(TAG, "message : ${profileResponse.message}")
//                            val dataPasien = profileResponse.dataPasien
//                            binding.tvPasienNama.text = dataPasien.nama
//                        }
//                    }
//                    Status.ERROR -> {
//                        loadingDialog.dismissDialog()
//                        Log.d(TAG, "Error : ${profile.message}")
//                    }
//                }
//            }
//        }

        binding.btnLogout.setOnClickListener {
            stateViewModel.apply {
                saveLoginState(false)
                saveToken("")
            }
            val intent = Intent(this,LoginActivity::class.java)
            startActivity(intent)
            finish()
        }

    }


    private fun getProfilePasien(token:String) {
        profileViewModel.getProfile(token).observe(this) { profile ->
            when (profile.status) {
                Status.LOADING -> {
//                    loadingDialog.startLoading()
                    Log.d(TAG, "Loading")
                }
                Status.SUCCESS -> {
//                    loadingDialog.dismissDialog()
                    val profileResponse = profile.data
                    if (profileResponse != null) {
                        Log.d(TAG, "message : ${profileResponse.message}")
                        val dataPasien = profileResponse.dataPasien
                        binding.tvPasienNama.text = dataPasien.nama
                    }
                }
                Status.ERROR -> {
                    Log.d(TAG, "Error : ${profile.message}")
                }
            }
        }
    }


    override fun onDestroy() {
        super.onDestroy()
        binding
    }

    companion object {
        const val TAG = "DashboardActivity"
    }
}