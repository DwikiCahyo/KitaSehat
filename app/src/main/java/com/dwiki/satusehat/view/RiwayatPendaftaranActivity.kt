package com.dwiki.satusehat.view

import android.content.Intent
import android.content.SharedPreferences
import android.graphics.drawable.ColorDrawable
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.view.View
import android.widget.AdapterView
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.dwiki.satusehat.R
import com.dwiki.satusehat.adapter.RiwayatAdapter
import com.dwiki.satusehat.adapter.RiwayatUmumAdapter
import com.dwiki.satusehat.model.responseModel.DataRiwayatAntreanBpjsItem
import com.dwiki.satusehat.model.responseModel.DataRiwayatAntreanUmumItem
import com.dwiki.satusehat.databinding.ActivityRiwayatPendaftaranBinding
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewmodel.RiwayatPendaftaranViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class RiwayatPendaftaranActivity : AppCompatActivity() {
    private lateinit var binding:ActivityRiwayatPendaftaranBinding
    private lateinit var pref: SharedPreferences
    private lateinit var mAdapter: RiwayatAdapter
    private lateinit var uAdapter: RiwayatUmumAdapter
    private val viewModel:RiwayatPendaftaranViewModel by viewModels()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityRiwayatPendaftaranBinding.inflate(layoutInflater)
        setContentView(binding.root)

        window.statusBarColor = ContextCompat.getColor(this, R.color.white)
        supportActionBar?.title = "Riwayat Pendaftaran"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this, R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

        //setup shared pref
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token  = pref.getString("key_token","KOSONG")

        token?.let {
            viewModel.getRiwayatPendaftaran(it)
        }

        token?.let {
            viewModel.getRiwayatPendaftaranUmum(it)
        }

        binding.spRiwayat.onItemSelectedListener = object :AdapterView.OnItemSelectedListener{
            override fun onItemSelected(adapterView: AdapterView<*>?, view: View?, pos: Int, id: Long) {
                when(pos){
                    0 -> {
                        getRiwayatBPJS()
                        binding.tvRiwayatPendaftaran.text = "Riwayat Pendaftaran BPJS"
                    }
                    1 -> {
                        getRiwayatUmum()
                        binding.tvRiwayatPendaftaran.text = "Riwayat Pendaftaran Umum"
                    }
                }
            }
            override fun onNothingSelected(p0: AdapterView<*>?) {
                getRiwayatBPJS()
            }
        }

    }

    private fun getRiwayatUmum() {
        viewModel.responseRiwayatPendaftaranUmum.observe(this) { riwayatUmum ->
            when(riwayatUmum.status){
                Status.SUCCESS -> {
                    val riwayatResponse = riwayatUmum.data
                    binding.recyclerView.layoutManager =
                        LinearLayoutManager(this, RecyclerView.VERTICAL, false)
                    uAdapter = RiwayatUmumAdapter(riwayatResponse!!.dataRiwayatAntreanUmum)
                    binding.recyclerView.adapter = uAdapter
                    riwayatResponse.dataRiwayatAntreanUmum.map {
                        val date = it.waktu.substring(0, 10)
                        Log.d("RiwayatPendaftaranActivity", date)
                    }
                    uAdapter.setOnItemClickCallback(object : RiwayatUmumAdapter.OnItemClickCallback{
                        override fun onItemClicked(listRiwayatUmum: DataRiwayatAntreanUmumItem) {
                            val intent = Intent(this@RiwayatPendaftaranActivity, DetailRiwayatActivity::class.java)
                            val bundle = Bundle()
                            bundle.putInt("id", listRiwayatUmum.id)
                            bundle.putString("jenis","umum")
                            intent.putExtras(bundle)
                            startActivity(intent)
                        }

                    })
                }
                Status.LOADING -> {
                    Log.d("RiwayatPendaftaranActivity", "Loading")
                }
                Status.ERROR -> {
                    Log.d("RiwayatPendaftaranActivity", "Error, ${riwayatUmum.message}")
                }
            }
        }
    }

    private fun getRiwayatBPJS() {
        viewModel.responseRiwayatPendaftaran.observe(this) { riwayat ->
            when (riwayat.status) {
                Status.SUCCESS -> {
                    val riwayatResponse = riwayat.data

                    binding.recyclerView.layoutManager =
                        LinearLayoutManager(this, RecyclerView.VERTICAL, false)
                    mAdapter = RiwayatAdapter(riwayatResponse!!.dataRiwayatAntreanBpjs)
                    binding.recyclerView.adapter = mAdapter
                    riwayatResponse.dataRiwayatAntreanBpjs.map {
                        val date = it.waktu.substring(0, 10)
                        Log.d("RiwayatPendaftaranActivity", date)
                    }
                    mAdapter.setOnItemClickCallback(object : RiwayatAdapter.OnItemClickCallback{
                        override fun onItemClicked(listRiwayatBpjs: DataRiwayatAntreanBpjsItem) {
                            val intent = Intent(this@RiwayatPendaftaranActivity, DetailRiwayatActivity::class.java)
                            val bundle = Bundle()
                            bundle.putInt("id", listRiwayatBpjs.id)
                            bundle.putString("jenis","BPJS")
                            intent.putExtras(bundle)
                            startActivity(intent)
                        }
                    })
                }
                Status.LOADING -> {
                    Log.d("RiwayatPendaftaranActivity", "Loading")
                }
                Status.ERROR -> {
                    Log.d("RiwayatPendaftaranActivity", "Error, ${riwayat.message}")
                }
            }
        }
    }

}