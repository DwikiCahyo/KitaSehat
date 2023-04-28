package com.dwiki.satusehat.ui

import android.content.Intent
import android.content.SharedPreferences
import android.graphics.Color
import android.graphics.drawable.ColorDrawable
import android.os.Bundle
import android.util.Log
import android.view.View
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.core.content.ContextCompat
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.dwiki.satusehat.R
import com.dwiki.satusehat.adapter.RumahSakitAdapter
import com.dwiki.satusehat.databinding.ActivityPendaftaranRumahSakitBinding
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewModel.RumahSakitViewModel
import dagger.hilt.android.AndroidEntryPoint
import javax.inject.Inject


@AndroidEntryPoint
class PendaftaranRumahSakitActivity : AppCompatActivity() {

    private lateinit var binding:ActivityPendaftaranRumahSakitBinding
    //call shared pref
    private lateinit var pref: SharedPreferences
    private val viewModel:RumahSakitViewModel by viewModels()
    private lateinit var rsAdapter:RumahSakitAdapter


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityPendaftaranRumahSakitBinding.inflate(layoutInflater)
        setContentView(binding.root)

        window.statusBarColor = ContextCompat.getColor(this,R.color.white)
        supportActionBar?.title = "Pilih rumah sakit"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this,R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

        //setup for rv
        rsAdapter = RumahSakitAdapter(ArrayList())
        initRecycleView()

        //init pref
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token = pref.getString("key_token","KOSONG")

        if (token != null) {
            getListRumahsakit(token)
        }


    }

    private fun initRecycleView() {
        binding.rvListRs.apply {
            adapter = rsAdapter
            layoutManager = LinearLayoutManager(this@PendaftaranRumahSakitActivity,LinearLayoutManager.VERTICAL,false)
        }
    }

    private fun getListRumahsakit(token:String) {
        viewModel.getRumahSakit(token)
        viewModel.responseRumahSakit.observe(this){ listRS ->
            when(listRS.status){

                Status.SUCCESS->{
                    val rumahSakitResponse = listRS.data
                    if(rumahSakitResponse != null){
                        binding.layoutContentList.visibility = View.VISIBLE
                        binding.shimmerFrameLayout.stopShimmer()
                        binding.shimmerFrameLayout.visibility = View.GONE
                        binding.tvTersediaRs.text = "Rumah sakit tersedia: ${rumahSakitResponse.listRumahSakit.size}"
                        val listRs = rumahSakitResponse.listRumahSakit
                        rsAdapter.setData(listRs)
                        initRecycleView()
                        Log.d(TAG,rumahSakitResponse.message)
                    }
                }
                Status.ERROR->{
                    binding.shimmerFrameLayout.stopShimmer()
                    binding.shimmerFrameLayout.visibility = View.GONE
                    binding.rvListRs.visibility = View.GONE
                    binding.tvTersediaRs.text = "Tidak ada data"
                    Log.e(DashboardActivity.TAG, "Error : ${listRS.message}")
                }
                Status.LOADING->{
                    binding.layoutContentList.visibility = View.INVISIBLE
                    binding.shimmerFrameLayout.startShimmer()
                    Log.d(TAG, "Loading")
                }
            }

        }
    }

    override fun onSupportNavigateUp(): Boolean {
        val intent = Intent(this, DashboardActivity::class.java)
        startActivity(intent)
        return true
    }

    companion object{
        const val TAG = "PendaftaranRumahSakitActivity"
    }

}