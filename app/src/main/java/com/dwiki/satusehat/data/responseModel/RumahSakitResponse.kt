package com.dwiki.satusehat.data.responseModel

import com.google.gson.annotations.SerializedName

data class RumahSakitResponse(

	@field:SerializedName("list_rumah_sakit")
	val listRumahSakit: List<ListRumahSakitItem>,

	@field:SerializedName("message")
	val message: String
)

data class ListRumahSakitItem(

	@field:SerializedName("nama")
	val nama: String,

	@field:SerializedName("daerah")
	val daerah: Daerah,

	@field:SerializedName("id")
	val id: Int
)

data class Daerah(

	@field:SerializedName("nama_daerah")
	val namaDaerah: String,

	@field:SerializedName("jenis")
	val jenis: String
)
