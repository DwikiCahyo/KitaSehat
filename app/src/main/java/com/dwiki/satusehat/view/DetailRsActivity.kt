package com.dwiki.satusehat.view

import android.content.SharedPreferences
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import androidx.recyclerview.widget.LinearLayoutManager
import com.bumptech.glide.Glide
import com.dwiki.satusehat.R
import com.dwiki.satusehat.adapter.FasilitasAdapter
import com.dwiki.satusehat.databinding.ActivityDetailRsBinding
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewmodel.DetailRumahSakitViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class DetailRsActivity : AppCompatActivity() {

    private lateinit var binding:ActivityDetailRsBinding
    private lateinit var pref: SharedPreferences
    private val detailViewModel:DetailRumahSakitViewModel by viewModels()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityDetailRsBinding.inflate(layoutInflater)
        setContentView(binding.root)

        window.statusBarColor = ContextCompat.getColor(this,R.color.white)


        //get user token
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token  = pref.getString("key_token","KOSONG")

        //get bundle data rumah sakit
        val bundle = intent.extras
        val idRumahSakit = bundle?.getInt("id")


        //get data
        detailViewModel.getDetailRumahSakit(token!!,idRumahSakit!!)
        detailViewModel.responseDetailRumahSakitResponse.observe(this) {
            when(it.status){
                Status.LOADING -> {
                    Log.d("Detail RS" ,"Loading")
                }
                Status.SUCCESS -> {
                    Glide.with(this).load(it.data?.dataRumahSakit?.fotoRumahSakit).into(binding.ivFotoRumahSakit)
                    binding.tvNamaRumahSakit.text = it.data?.dataRumahSakit?.nama
                    binding.tvJenisRumahSakit.text = it.data?.dataRumahSakit?.daerah!!.jenis
                    binding.tvAlamatRumahSakit.text = it.data?.dataRumahSakit!!.alamat
                    binding.tvFasilitas.text = "Fasilitas tersedia : ${it.data.dataRumahSakit.fasilitasRumahSakit.size}"
                    binding.rvFasilitas.apply {
                        adapter = FasilitasAdapter(it.data.dataRumahSakit.fasilitasRumahSakit)
                        layoutManager = LinearLayoutManager(this@DetailRsActivity, LinearLayoutManager.VERTICAL,false)
                        setHasFixedSize(true)
                        isNestedScrollingEnabled = false
                    }
                    it.data?.dataRumahSakit?.fasilitasRumahSakit?.map {
                        Log.d("Detail RS", it.fasilitas.namaLayanan)
                    }
                    val nama = it.data!!.dataRumahSakit.nama
                    val daerah = it.data.dataRumahSakit.daerah.namaDaerah
                    val foto = it.data.dataRumahSakit.fotoRumahSakit

//                    daftarLayanan(idRumahSakit,nama,daerah,foto)
                }
                Status.ERROR -> {
                    Log.e("Detail RS", it.message.toString())
                }
            }
        }


    }

//    private fun daftarLayanan(id:Int,name:String,daerah:String,foto:String) {
//
//        binding.btnDaftarLayanan.setOnClickListener {
//            val rumahSakit = RumahSakit(id,name,daerah,foto)
//            val intent = Intent(this@DetailRsActivity, PendaftaranAntreanActivity::class.java)
//            intent.putExtra("data_rs",rumahSakit)
//            startActivity(intent)
//        }
//
//    }

}