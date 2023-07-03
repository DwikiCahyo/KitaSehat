package com.dwiki.satusehat.model.responseModel

import com.google.gson.annotations.SerializedName

data class DetailRumahSakitResponse(

    @field:SerializedName("data_rumah_sakit")
	val dataRumahSakit: DataRumahSakit,

    @field:SerializedName("message")
	val message: String
)

data class PraktikPoliItem(

    @field:SerializedName("dokter")
	val dokter: Dokter,

    @field:SerializedName("jam_praktik")
	val jamPraktik: String,

    @field:SerializedName("hari_praktik")
	val hariPraktik: String
)

data class KoordinatRumahSakit(

	@field:SerializedName("coordinates")
	val coordinates: List<Any>,

	@field:SerializedName("type")
	val type: String
)

data class DaerahRumahSakit(

	@field:SerializedName("nama_daerah")
	val namaDaerah: String,

	@field:SerializedName("jenis")
	val jenis: String
)

data class AntreanBpjsItem(

	@field:SerializedName("jumlah_antrean_bpjs_selesai")
	val jumlahAntreanBpjsSelesai: Int,

	@field:SerializedName("total_antrean_bpjs")
	val totalAntreanBpjs: Int
)

data class AntreanUmumItem(
	@field:SerializedName("jumlah_antrean_umum_selesai")
	val jumlahAntreanUmumSelesai: Int,

	@field:SerializedName("total_antrean_umum")
	val totalAntreanUmum: Int
)

data class Fasilitas(

    @field:SerializedName("antrean_umum")
	val antreanUmum: List<AntreanUmumItem>,

    @field:SerializedName("antrean_bpjs")
	val antreanBpjs: List<AntreanBpjsItem>,

    @field:SerializedName("nama_layanan")
	val namaLayanan: String
)

data class DataRumahSakit(

    @field:SerializedName("fasilitas_rumah_sakit")
	val fasilitasRumahSakit: List<FasilitasRumahSakitItem>,

    @field:SerializedName("nama")
	val nama: String,

    @field:SerializedName("daerah")
	val daerah: DaerahRumahSakit,

    @field:SerializedName("koordinat")
	val koordinat: KoordinatRumahSakit,

    @field:SerializedName("foto_rumah_sakit")
	val fotoRumahSakit: String,

    @field:SerializedName("alamat")
	val alamat: String
)

data class FasilitasRumahSakitItem(

    @field:SerializedName("jam_buka")
	val jamBuka: Any,

    @field:SerializedName("hari_buka")
	val hariBuka: Any,

    @field:SerializedName("fasilitas")
	val fasilitas: Fasilitas,

    @field:SerializedName("praktik_poli")
	val praktikPoli: List<PraktikPoliItem>
)

data class Dokter(

	@field:SerializedName("nama_dokter")
	val namaDokter: String
)
