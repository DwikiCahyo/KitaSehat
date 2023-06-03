package com.dwiki.satusehat.data.responseModel

import com.google.gson.annotations.SerializedName

data class RiwayatPendaftaranUmumResponse(

	@field:SerializedName("data_riwayat_antrean_umum")
	val dataRiwayatAntreanUmum: List<DataRiwayatAntreanUmumItem>,

	@field:SerializedName("message")
	val message: String
)

data class DataRiwayatAntreanUmumItem(

	@field:SerializedName("rumah_sakit.Rumah Sakit")
	val rumahSakitRumahSakit: String,

	@field:SerializedName("waktu")
	val waktu: String,

	@field:SerializedName("id")
	val id: Int
)
