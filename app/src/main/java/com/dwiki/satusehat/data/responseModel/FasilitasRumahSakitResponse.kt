package com.dwiki.satusehat.data.responseModel

import com.google.gson.annotations.SerializedName

data class FasilitasRumahSakitResponse(

	@field:SerializedName("data_fasilitas_rumah_sakit")
	val dataFasilitasRumahSakit: List<DataFasilitasRumahSakitItem>,

	@field:SerializedName("message")
	val message: String
)

data class DataFasilitasRumahSakitItem(

	@field:SerializedName("fasilitas.nama_layanan")
	val fasilitasNamaLayanan: String,

	@field:SerializedName("id")
	val id: Int
)
