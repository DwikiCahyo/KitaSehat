package com.dwiki.satusehat

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import android.util.Log
import android.view.View
import android.widget.Toolbar
import androidx.activity.viewModels
import androidx.lifecycle.Observer
import com.dwiki.satusehat.databinding.ActivityMainBinding
import com.dwiki.satusehat.data.responseModel.RumahSakit
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewModel.MainViewModel
import dagger.hilt.android.AndroidEntryPoint


@AndroidEntryPoint
class MainActivity : AppCompatActivity() {
    private val mainViewModel : MainViewModel by viewModels()
    private lateinit var binding:ActivityMainBinding


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)
        setupViewModel()
        mainViewModel.fetchRumahSakit()
    }

    private fun setupViewModel() {
        mainViewModel.rumahSakit.observe(this, Observer {
            when(it.status){
                Status.SUCCESS -> {
                    it.data?.let { RumahSakit ->
//                        for (i in 0..1){
//                            Log.d("Main Activity",RumahSakit.toString())
//                        }
                        Log.d("Main Activity",RumahSakit.toString())
                    }
                }
                    Status.LOADING ->{
                        Log.d("Main Activity", "Loading Maseeeee")
                    }
                    Status.ERROR -> {
                        Log.d("Main Activity", "Error")
                    }
                }
            })
        }
    }