package com.dwiki.satusehat

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import com.dwiki.satusehat.databinding.ActivityMain2Binding

class MainActivity2 : AppCompatActivity() {
    private lateinit var binding: ActivityMain2Binding
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMain2Binding.inflate(layoutInflater)
        setContentView(binding.root)

        val nik = intent.getStringExtra(NIK)
        val pass1 = intent.getStringExtra(PASS1)
        val pass2 = intent.getStringExtra(PASS2)
        val dob = intent.getStringExtra(DOB)
        val agama = intent.getStringExtra(AGAMA)
        val pendidikan = intent.getStringExtra(PENDIDIKAN)
        val perkawinan = intent.getStringExtra(PERKAWINAN)
        val pekerjaan = intent.getStringExtra(PEKERJAAN)

        binding.tvHomepage1.text = nik
        binding.tvHomepage2.text = pass1
        binding.tvHomepage3.text = pass2
        binding.tvHomepage4.text = dob
        binding.tvHomepage5.text = agama
        binding.tvHomepage6.text = pendidikan
        binding.tvHomepage7.text = perkawinan
        binding.tvHomepage8.text = pekerjaan

    }

    companion object{
        const val DATA = "Data"
        const val NIK = "NIK"
        const val PASS1 = "Pass"
        const val PASS2 = "Pass"
        const val DOB = "dob"
        const val AGAMA = "AGAMA"
        const val PENDIDIKAN = "pendidikan"
        const val PERKAWINAN = "perkawianan"
        const val PEKERJAAN = "pekerjaan"

    }

}