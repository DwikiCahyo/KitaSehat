package com.dwiki.satusehat.ui.pendaftaran

import android.content.SharedPreferences
import android.graphics.drawable.ColorDrawable
import android.os.Build
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import androidx.core.content.ContextCompat
import com.bumptech.glide.Glide
import com.dwiki.satusehat.R
import com.dwiki.satusehat.adapter.SectionPagerAdapter
import com.dwiki.satusehat.databinding.ActivityPendaftaranAntreanBinding
import com.dwiki.satusehat.model.RumahSakit
import com.google.android.material.tabs.TabLayoutMediator
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class PendaftaranAntreanActivity : AppCompatActivity() {

    private lateinit var binding:ActivityPendaftaranAntreanBinding
    private lateinit var pref: SharedPreferences


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityPendaftaranAntreanBinding.inflate(layoutInflater)
        setContentView(binding.root)


        //setup for app bar
        window.statusBarColor = ContextCompat.getColor(this,R.color.white)
        supportActionBar?.title = "Daftar Layanan "
        supportActionBar?.subtitle = "Silahkan pilih layanan"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this,R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

        //init shared pref
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token  = pref.getString("key_token","KOSONG")

        //get data from
        val rumahSakit = if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
            intent.getParcelableExtra("data_rs", RumahSakit::class.java)
        } else {
            intent.getParcelableExtra("data_rs")
        }

        //setup for card rumah sakit pilihan
        val namaRs = rumahSakit?.nama
        val alamatRs = rumahSakit?.daerah
        val fotoRs = rumahSakit?.foto
        val idRs = rumahSakit?.id
        Glide.with(this).load(fotoRs).centerCrop().into(binding.ivProfileRumahSakit)
        if (fotoRs == null) {
            Glide.with(this).load(R.drawable.ic_no_image).centerCrop().into(binding.ivProfileRumahSakit)
        }

        binding.tvNamaRs.text = namaRs
        binding.tvLokasiRs.text = alamatRs
        Log.d(TAG,idRs.toString())

        //setup section pager
        val sectionPagerAdapter = SectionPagerAdapter(this)
        binding.viewPager.adapter = sectionPagerAdapter
        TabLayoutMediator(binding.tabs, binding.viewPager) { tab, position -> tab.text = resources.getString(
            TAB_TITLES[position])}.attach()



    }
    companion object{
        const val TAG = "Pendaftaraan antrean"
        private val TAB_TITLES = intArrayOf(
            R.string.tab_text_bpjs,
            R.string.tab_text_umum
        )
    }
}