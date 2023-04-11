package com.dwiki.satusehat.model

import android.os.Parcelable
import kotlinx.parcelize.Parcelize


@Parcelize
data class Pasien(
    val nikPasien:Int,
    val namaPasien: String,
    val nama:String,
    val jenisKelamin:String,
    val tanggalLahir:String,
    val agama:String,
    val pekerjaan:String,
    val pendidikan:String,
    val statusPerkawinan:String,
    val noBpjs:String,
    val noHP:String,
    val password: String
):Parcelable

data class PasienLogin(
    val nik:String,
    val password: String
)

data class PasienSignUp(
    val nik:String,
    val nama:String,
    val jenisKelamin:String,
    val ttl:String,
    val agama:String,
    val pekerjaan: String,
    val pendidikan: String,
    val statusPerkawinan: String,
    val noBpjs: String,
    val noHP: String,
    val password: String
)