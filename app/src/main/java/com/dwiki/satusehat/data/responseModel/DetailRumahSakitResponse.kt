package com.dwiki.satusehat.data.responseModel

import com.google.gson.annotations.SerializedName

data class DetailRumahSakitResponse(

	@field:SerializedName("data_rumah_sakit")
	val dataRumahSakit: DataRumahSakit,

	@field:SerializedName("message")
	val message: String
)

data class DetailKoordinat(

	@field:SerializedName("coordinates")
	val coordinates: List<Any>,

	@field:SerializedName("type")
	val type: String
)

data class Fasilitas(

	@field:SerializedName("nama_layanan")
	val namaLayanan: String
)

data class FasilitasRumahSakitItem(

	@field:SerializedName("fasilitas_id")
	val fasilitasId: Int,

	@field:SerializedName("fasilitas")
	val fasilitas: Fasilitas
)

data class DataRumahSakit(

	@field:SerializedName("fasilitas_rumah_sakit")
	val fasilitasRumahSakit: List<FasilitasRumahSakitItem>,

	@field:SerializedName("nama")
	val nama: String,

	@field:SerializedName("daerah")
	val daerah: Daerah,

	@field:SerializedName("koordinat")
	val koordinat: Koordinat,

	@field:SerializedName("foto_rumah_sakit")
	val fotoRumahSakit: String,

	@field:SerializedName("alamat")
	val alamat: String
)

data class DetailDaerah(

	@field:SerializedName("nama_daerah")
	val namaDaerah: String,

	@field:SerializedName("jenis")
	val jenis: String
)
