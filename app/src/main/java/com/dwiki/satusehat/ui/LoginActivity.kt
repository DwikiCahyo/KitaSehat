package com.dwiki.satusehat.ui

import android.app.Activity
import android.content.Intent
import android.content.SharedPreferences
import android.os.Build
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import android.util.Log
import android.view.View
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AlertDialog
import androidx.core.content.ContextCompat
import androidx.lifecycle.Observer
import androidx.lifecycle.lifecycleScope
import com.dwiki.satusehat.R
import com.dwiki.satusehat.util.Utils
import com.dwiki.satusehat.databinding.ActivityLoginBinding
import com.dwiki.satusehat.util.KeyboardUtils
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewModel.LoginViewModel
import com.dwiki.satusehat.viewModel.StateViewModel
import dagger.hilt.android.AndroidEntryPoint
import dagger.hilt.android.internal.managers.FragmentComponentManager
import kotlinx.coroutines.delay
import kotlinx.coroutines.launch
import org.json.JSONObject
import org.json.JSONTokener

@AndroidEntryPoint
class LoginActivity : AppCompatActivity() {

    private lateinit var binding:ActivityLoginBinding
    private val loginViewModel:LoginViewModel by viewModels()
    private val stateViewModel: StateViewModel by viewModels()
    private lateinit var pref: SharedPreferences


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityLoginBinding.inflate(layoutInflater)
        setContentView(binding.root)

        //init pref
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)


        val loading = LoadingDialog(this)



        nikWatcher()
        passwordWatcher()
        Utils.setSignEnabled(binding.edtNik.text!!, binding.edtPassword.text!!,binding.btnMasuk,binding.tvErrorFormatNik)

        binding.btnTvDaftar.setOnClickListener {
            KeyboardUtils.hideKeyboard(this, binding.edtNik)
            RegisterDialog().show(supportFragmentManager, "RegisterDialog")
        }


        binding.btnMasuk.setOnClickListener { it ->

            KeyboardUtils.hideKeyboard(this, it)
            val nik = binding.edtNik.text.toString()
            val password = binding.edtPassword.text.toString()
            loginViewModel.loginPasien(nik, password).observe(this){ pasienResponse ->
                when(pasienResponse.status){

                    Status.SUCCESS -> {
                        loading.dismissDialog()
                        val loginResponse = pasienResponse.data
                        if (loginResponse != null){
                            Log.d(TAG, loginResponse.message)
                            //save state user
                            val editor = pref.edit()
                            editor.putString("key_token",loginResponse.token)
                            editor.apply()
                            //using view model
                            stateViewModel.saveLoginState(true)
                            stateViewModel.saveToken(loginResponse.token)
                            //if success go to dashboard activity
                            val intent = Intent(this,DashboardActivity::class.java)
                            startActivity(intent)
                            finish()
                        }
                    }

                    Status.LOADING ->{
                        loading.startLoading()
                        Log.d(TAG, "Progress Loading")
                    }

                    Status.ERROR ->{
                        loading.dismissDialog()
                        //convert json error message to token
                        val jsonObject = JSONTokener(pasienResponse.message).nextValue() as JSONObject
                        val msg = jsonObject.getString("message")
                        when(msg){
                            "NIK not found" -> {
                                binding.edtNik.requestFocus()
                                Utils.nikNotFound(binding.tvErrorFormatNik)
                            }
                            "wrong password" -> {
                                binding.edtPassword.requestFocus()
                                Utils.wrongPass(binding.tvErrorFormatPass)
                            }
                        }
                        Log.d(TAG,"${pasienResponse.data}, ${pasienResponse.message}")
                    }
                }
            }
        }
    }

    override fun onResume() {
        super.onResume()
        stateViewModel.getLoginState().observe(this){
            Log.d("Login Activity", it.toString())
        }

        stateViewModel.getToken().observe(this){
            Log.d("Login Activity", it.toString())
        }
    }

    private fun passwordWatcher() {
        binding.edtPassword.addTextChangedListener(object : TextWatcher {
            override fun beforeTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                //
            }

            override fun onTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                Utils.setSignEnabled(binding.edtNik.text!!, binding.edtPassword.text!!,binding.btnMasuk,binding.tvErrorFormatNik)
            }

            override fun afterTextChanged(p0: Editable?) {
                Utils.passLength(binding.tvErrorFormatPass, p0)
            }

        })
    }

    private fun nikWatcher() {
        binding.edtNik.addTextChangedListener(object : TextWatcher {


            private val CONTINUOUS_PATTERN = "(\\d)\\1{4,}"

            fun isContinuousDigits(nik: String): Boolean {
                return CONTINUOUS_PATTERN.toRegex().containsMatchIn(nik)
            }

            override fun beforeTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                //
            }

            override fun onTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {

                Utils.setSignEnabled(binding.edtNik.text!!, binding.edtPassword.text!!,binding.btnMasuk,binding.tvErrorFormatNik)
            }

            override fun afterTextChanged(p0: Editable?) {
                val nik = p0.toString().trim()
                if (isContinuousDigits(nik)){
                    binding.tvErrorFormatNik.visibility = View.VISIBLE
                } else {
                    binding.tvErrorFormatNik.visibility = View.GONE

                }
                binding.tvCounter.visibility = View.VISIBLE
                Utils.counterText(binding.tvCounter, "/16", p0)
            }
        })
    }

    companion object{
        const val TAG = "LoginActivity"
    }
}