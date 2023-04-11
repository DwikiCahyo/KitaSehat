package com.dwiki.satusehat.data.responseModel

import com.google.gson.annotations.SerializedName

data class RumahSakit(

    @field:SerializedName("get_rumah_sakit")
	val getRumahSakit: List<GetRumahSakitItem>,

    @field:SerializedName("message")
	val message: String? = null
)

data class GetRumahSakitItem(

	@field:SerializedName("nama")
	val nama: String? = null,

	@field:SerializedName("daerah.nama_daerah")
	val daerahNamaDaerah: String? = null,

	@field:SerializedName("id")
	val id: Int? = null,

	@field:SerializedName("daerah.jenis")
	val daerahJenis: String? = null
)
