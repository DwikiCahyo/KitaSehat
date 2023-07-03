package com.dwiki.satusehat.view

import android.content.Intent
import android.content.SharedPreferences
import android.graphics.drawable.ColorDrawable
import android.net.Uri
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.widget.Toast
import androidx.activity.result.contract.ActivityResultContracts
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import com.bumptech.glide.Glide
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.ActivityEditFotoProfilBinding
import com.dwiki.satusehat.view.dialog.SuccessDialog
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.util.Utils
import com.dwiki.satusehat.viewmodel.PasienProfileViewModel
import dagger.hilt.android.AndroidEntryPoint
import okhttp3.MediaType.Companion.toMediaTypeOrNull
import okhttp3.MultipartBody
import okhttp3.RequestBody.Companion.asRequestBody
import java.io.File


@AndroidEntryPoint
class EditFotoProfilActivity : AppCompatActivity() {

    private lateinit var binding: ActivityEditFotoProfilBinding
    private val pasienProfileViewModel: PasienProfileViewModel by viewModels()
    private val profileViewModel: PasienProfileViewModel by viewModels()
    private lateinit var pref: SharedPreferences
    private var getFile: File? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityEditFotoProfilBinding.inflate(layoutInflater)
        setContentView(binding.root)

        window.statusBarColor = ContextCompat.getColor(this, R.color.white)
        supportActionBar?.title = "Edit Foto Profile"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this, R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

        binding.btnOpenGallery.setOnClickListener {
            val intent = Intent()
            intent.action = Intent.ACTION_GET_CONTENT
            intent.type = "image/*"
            val chooser = Intent.createChooser(intent,"Choose a Picture")
            intentGallery.launch(chooser)

        }

        //token
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token = pref.getString("key_token","KOSONG")!!

        binding.btnSimpanFoto.setOnClickListener {  uploadImage(token) }
        getImage(token)


    }

    private fun uploadImage(token: String) {
        if (getFile != null) {
            val file = Utils.reduceFileImage(getFile as File)
            val reqImage = file.asRequestBody("image/jpg".toMediaTypeOrNull())
            val imageMultipart = MultipartBody.Part.createFormData("photo", file.name, reqImage)
            pasienProfileViewModel.uploadImage(token, imageMultipart)
            pasienProfileViewModel.responseEditFotoProfile.observe(this) {
                when (it.status) {
                    Status.SUCCESS -> {
                        SuccessDialog("Berhasil Upload foto").show(
                            supportFragmentManager,
                            "success Upload Foto"
                        )
                    }
                    else -> {
                        Toast.makeText(this, "Gagal Upload Foto", Toast.LENGTH_SHORT).show()
                    }
                }
            }
        } else {
            Toast.makeText(this, "Masukan Foto terlebih Dahulu", Toast.LENGTH_SHORT).show()
        }
    }

    private fun getImage(token:String) {
        pasienProfileViewModel.getProfile(token).observe(this){
            when(it.status){
                Status.SUCCESS -> {
                    val fotoProfil = it.data?.dataPasien?.fotoProfil
                    if (fotoProfil != null) {
                        Glide.with(this).load(fotoProfil).into(binding.ivFotoProfil)
                    } else {
                        binding.ivFotoProfil.setImageResource(R.drawable.ic_default_profile)
                    }


                }
                else -> {
                    Log.e("Edit Profile Activity","Data gagal dimuat")
                }
            }
        }
    }

    private val intentGallery = registerForActivityResult(
        ActivityResultContracts.StartActivityForResult()
    ) {
        if (it.resultCode == RESULT_OK) {
            val selectImage: Uri = it.data?.data as Uri
            val file = Utils.uriToFile(selectImage, this)
            getFile = file
            binding.ivFotoProfil.setImageURI(selectImage)
        }
    }
}