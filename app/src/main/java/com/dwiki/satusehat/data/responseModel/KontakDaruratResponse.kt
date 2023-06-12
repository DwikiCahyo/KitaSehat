package com.dwiki.satusehat.data.responseModel

import com.google.gson.annotations.SerializedName

data class KontakDaruratResponse(

	@field:SerializedName("message")
	val message: String,

	@field:SerializedName("list_kontak_darurat")
	val listKontakDarurat: List<ListKontakDaruratItem>
)

data class ListKontakDaruratItem(

	@field:SerializedName("nama")
	val nama: String,

	@field:SerializedName("no_hp")
	val noHp: String,

	@field:SerializedName("id")
	val id: Int
)
