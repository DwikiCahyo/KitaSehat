package com.dwiki.satusehat.model.responseModel

import com.google.gson.annotations.SerializedName

data class FasilitasRumahSakitResponse(

    @field:SerializedName("data_fasilitas_rumah_sakit")
	val dataFasilitasRumahSakit: List<DataFasilitasRumahSakitItem>,

    @field:SerializedName("message")
	val message: String? = null
)

data class DataFasilitasRumahSakitItem(

	@field:SerializedName("jam_buka")
	val jamBuka: Any? = null,

	@field:SerializedName("hari_buka")
	val hariBuka: Any? = null,

	@field:SerializedName("id")
	val id: Int? = null,

	@field:SerializedName("fasilitas.nama_layanan")
	val fasilitasNamaLayanan: String? = null
)
