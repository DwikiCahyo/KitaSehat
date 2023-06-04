package com.dwiki.satusehat.data.responseModel

import com.google.gson.annotations.SerializedName

data class ProfileItemResponse(

	@field:SerializedName("nama")
	val nama: String,

	@field:SerializedName("pekerjaan")
	val pekerjaan: String,

	@field:SerializedName("pendidikan")
	val pendidikan: String,

	@field:SerializedName("no_hp")
	val noHp: String,

	@field:SerializedName("no_bpjs")
	val noBpjs: String,

	@field:SerializedName("agama")
	val agama: String,

	@field:SerializedName("jenis_kelamin")
	val jenisKelamin: String,

	@field:SerializedName("tanggal_lahir")
	val tanggalLahir: String,

	@field:SerializedName("status_perkawinan")
	val statusPerkawinan: String
)
