package com.dwiki.satusehat.data.responseModel

import com.google.gson.annotations.SerializedName

data class RiwayatPendaftaranResponse(

	@field:SerializedName("data_riwayat_antrean_bpjs")
	val dataRiwayatAntreanBpjs: List<DataRiwayatAntreanBpjsItem>,

	@field:SerializedName("message")
	val message: String
)

data class DataRiwayatAntreanBpjsItem(

	@field:SerializedName("rumah_sakit.Rumah Sakit")
	val rumahSakitRumahSakit: String,

	@field:SerializedName("waktu")
	val waktu: String,

	@field:SerializedName("id")
	val id: Int
)
