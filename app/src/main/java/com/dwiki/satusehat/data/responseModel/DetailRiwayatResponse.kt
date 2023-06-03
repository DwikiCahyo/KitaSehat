package com.dwiki.satusehat.data.responseModel

import com.google.gson.annotations.SerializedName

data class DetailRiwayatResponse(

	@field:SerializedName("rumah_sakit.Rumah Sakit")
	val rumahSakitRumahSakit: String,

	@field:SerializedName("pasien_id")
	val pasienId: Int,

	@field:SerializedName("fasilitas.Layanan")
	val fasilitasLayanan: String,

	@field:SerializedName("waktu")
	val waktu: String,

	@field:SerializedName("nomor_antrean")
	val nomorAntrean: Int,

	@field:SerializedName("message")
	val message: String,

	@field:SerializedName("status")
	val status: String,

	@field:SerializedName("keluhan_awal")
	val keluhanAwal: String
)
