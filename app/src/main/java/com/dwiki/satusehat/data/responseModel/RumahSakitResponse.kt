package com.dwiki.satusehat.data.responseModel

import android.os.Parcelable
import com.google.gson.annotations.SerializedName
import kotlinx.parcelize.Parcelize
import java.io.Serializable

data class RumahSakitResponse(

	@field:SerializedName("list_rumah_sakit")
	val listRumahSakit: List<ListRumahSakitItem>,

	@field:SerializedName("message")
	val message: String
)

data class Koordinat(

	@field:SerializedName("coordinates")
	val coordinates: List<Any>,

	@field:SerializedName("type")
	val type: String
)

data class ListRumahSakitItem(

	@field:SerializedName("nama")
	val nama: String,

	@field:SerializedName("daerah")
	val daerah: Daerah,

	@field:SerializedName("id")
	val id: Int,

	@field:SerializedName("koordinat")
	val koordinat: Koordinat,

	@field:SerializedName("foto_rumah_sakit")
	val fotoRumahSakit: String
)

data class Daerah(

	@field:SerializedName("nama_daerah")
	val namaDaerah: String,

	@field:SerializedName("jenis")
	val jenis: String
)
