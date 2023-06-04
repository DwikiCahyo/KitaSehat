package com.dwiki.satusehat.ui

import android.app.DatePickerDialog
import android.content.SharedPreferences
import android.graphics.drawable.ColorDrawable
import android.nfc.Tag
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.widget.AdapterView
import android.widget.ArrayAdapter
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import com.bumptech.glide.Glide
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.ActivityEditProfileBinding
import com.dwiki.satusehat.databinding.ActivityProfileBinding
import com.dwiki.satusehat.ui.dialog.SuccessDialog
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewModel.PasienProfileViewModel
import dagger.hilt.android.AndroidEntryPoint
import java.util.*

@AndroidEntryPoint
class EditProfileActivity : AppCompatActivity() {

    private lateinit var binding:ActivityEditProfileBinding
    private val pasienProfileViewModel:PasienProfileViewModel by viewModels()
    private lateinit var pref: SharedPreferences
    private lateinit var pekerjaan:String
    private lateinit var agama:String
    private lateinit var perkawinan:String
    private lateinit var pendidikan:String
    private lateinit var jenisKelamin:String
    private lateinit var tanggalLahir:String
    private lateinit var nama:String
    private lateinit var noTelepon:String
    private lateinit var noBpjs:String


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityEditProfileBinding.inflate(layoutInflater)
        setContentView(binding.root)

        window.statusBarColor = ContextCompat.getColor(this,R.color.white)
        supportActionBar?.title = "Edit Profile"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this,R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)


        val hintAgama = resources.getStringArray(R.array.agama)
        val hintPekerjaan = resources.getStringArray(R.array.pekerjaan)
        val hintPerkawinan = resources.getStringArray(R.array.status_perkawinan)
        val hintPendidikan = resources.getStringArray(R.array.pendidikan)
        val hintJenisKelamin = resources.getStringArray(R.array.jenis_kelamin)
        setDatePicker()


        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token = pref.getString("key_token","KOSONG")!!

        //save new data
        editData(token)


        //get data pasien
        pasienProfileViewModel.getProfile(token).observe(this){
            when(it.status){
                Status.SUCCESS -> {
                    formPekerjaan(hintPekerjaan, it.data?.dataPasien?.pekerjaan ?: "KOSONG")
                    formAgama(hintAgama, it.data?.dataPasien?.agama ?: "KOSONG")
                    formPerkawinan(hintPerkawinan, it.data?.dataPasien?.statusPerkawinan ?: "KOSONG")
                    formPendidikan(hintPendidikan, it.data?.dataPasien?.pendidikan ?: "KOSONG")
                    formJenisKelamin(hintJenisKelamin, it.data?.dataPasien?.jenisKelamin ?: "KOSONG")
                    nama = it.data?.dataPasien?.nama!!
                    noTelepon = it.data.dataPasien.noHp
                    noBpjs = it.data.dataPasien.noBpjs
                    tanggalLahir = it.data.dataPasien.tanggalLahir
                    binding.edtTanggalLahir.setText(it.data?.dataPasien?.tanggalLahir?:"Kosong")
                    binding.edtNama.setText(it.data?.dataPasien?.nama)
                    binding.edtNoTelepon.setText(it.data?.dataPasien?.noHp)
                    binding.edtBpjs.setText(it.data?.dataPasien?.noBpjs)
                    if (it.data.dataPasien.fotoProfil != null){
                        Glide.with(this).load(it.data?.dataPasien?.fotoProfil).into(binding.ivFotoProfil)
                    } else {
                        Glide.with(this).load(R.drawable.ic_no_image).into(binding.ivFotoProfil)
                    }

                } else -> {
                    Log.e("Edit Profile Activity","Data gagal dimuat")
                }

            }
        }




    }

    private fun editData(token:String) {
        binding.btnSimpanData.setOnClickListener {
            nama = binding.edtNama.text.toString()
            pekerjaan = binding.edtPekerjaan.text.toString()
            noBpjs = binding.edtBpjs.text.toString()
            noTelepon = binding.edtNoTelepon.text.toString()
            pekerjaan = binding.edtPekerjaan.text.toString()
            pasienProfileViewModel.editProfile(token,nama,jenisKelamin,tanggalLahir,agama,pekerjaan,pendidikan,perkawinan,noBpjs,noTelepon)
            pasienProfileViewModel.responseEditProfile.observe(this){
                when(it.status){
                    Status.SUCCESS -> {
                        SuccessDialog("Berhasil Edit Profil").show(supportFragmentManager,"success")
                    }
                    else ->{
                        Log.e("Edit Profile Activity","Data gagal diedit")
                    }

                }
            }

        }
    }

    private fun formJenisKelamin(hintJenisKelamin:Array<String>,gJenisKelamin:String) {
        binding.edtJenisKelamin.apply {
            val adapterJenisKelamin = ArrayAdapter(this@EditProfileActivity, R.layout.dropdown_item, hintJenisKelamin)
            setAdapter(adapterJenisKelamin)
            setText(gJenisKelamin,false)
            setHint(context.getString(R.string.str_jenis_kelamin))
            jenisKelamin = gJenisKelamin
            onItemClickListener = AdapterView.OnItemClickListener{
                    _, _, position, _ ->
                jenisKelamin = adapterJenisKelamin.getItem(position).toString()
            }
        }
    }

    private fun setDatePicker() {
        binding.edtTanggalLahir.setOnClickListener{
            val calendar = Calendar.getInstance()

            val year = calendar.get(Calendar.YEAR)
            val month = calendar.get(Calendar.MONTH)
            val day = calendar.get(Calendar.DAY_OF_MONTH)

            val datePickerDialog = DatePickerDialog(this,
                { _, year, month, dayOfMonth ->
                    tanggalLahir = "$dayOfMonth/${month + 1}/$year"
                    binding.edtTanggalLahir.setText(tanggalLahir)
                },
                year, month, day,
            )
            datePickerDialog.show()
        }
    }

    private fun formPendidikan(hintPendidikan: Array<String>,gPendidikan:String) {
        binding.edtPendidikan.apply {
            val adapterPendidikan = ArrayAdapter(this@EditProfileActivity,R.layout.dropdown_item,hintPendidikan)
            setAdapter(adapterPendidikan)
            setText(gPendidikan,false)
            hint = "Pilih Pendidikan"
            pendidikan = gPendidikan
            onItemClickListener = AdapterView.OnItemClickListener{
                    _, _, position, _ ->
                pendidikan = adapterPendidikan.getItem(position).toString()
            }
        }
    }

    private fun formPerkawinan(hintPerkawinan: Array<String>,gPerkawinan:String) {
        binding.edtPerkawinan.apply {
            val adapterPerkawinan = ArrayAdapter(this@EditProfileActivity,R.layout.dropdown_item,hintPerkawinan)
            setAdapter(adapterPerkawinan)
            setText(gPerkawinan,false)
            hint = "Pilih Status Perkawinan"
            perkawinan = gPerkawinan
            onItemClickListener = AdapterView.OnItemClickListener { _, _, position, _ ->
                perkawinan = adapterPerkawinan.getItem(position).toString()
            }
        }
    }

    private fun formAgama(hintAgama: Array<String>,gAgama:String) {
        binding.edtAgama.apply {
            val adapterAgama = ArrayAdapter(this@EditProfileActivity, R.layout.dropdown_item, hintAgama)
            setAdapter(adapterAgama)
            setText(gAgama,false)
            hint = "Pilih Agama"
            agama = gAgama
            onItemClickListener = AdapterView.OnItemClickListener { _, _, position, _ ->
                agama = adapterAgama.getItem(position).toString()
            }
        }
    }


    private fun formPekerjaan(hintPekerjaan: Array<String>,gPekerjaan:String) {

        binding.edtPekerjaan.apply {
            val adapterPekerjaan = ArrayAdapter(this@EditProfileActivity, R.layout.dropdown_item, hintPekerjaan)
            setAdapter(adapterPekerjaan)
            setText(gPekerjaan,false)
        }
    }
}