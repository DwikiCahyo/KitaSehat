package com.dwiki.satusehat.model.responseModel

import com.google.gson.annotations.SerializedName

data class AntreanLiveResponse(

    @field:SerializedName("data")
	val data: DataAntreanLive,

    @field:SerializedName("message")
	val message: String
)

data class DataAntreanLive(

	@field:SerializedName("nomor_antrean")
	val nomorAntrean: Int,

	@field:SerializedName("jenis_pasien")
	val jenisPasien: String,

	@field:SerializedName("fasilitas")
	val fasilitas: String,

	@field:SerializedName("no_antrean_saat_ini")
	val noAntreanSaatIni: Int,

	@field:SerializedName("antrean_id")
	val antreanId: Int,

	@field:SerializedName("rumah_sakit")
	val rumahSakit: String,

	@field:SerializedName("tanggal_pendaftaran")
	val tanggalPendaftaran: String,

	@field:SerializedName("waktu_pendaftaran")
	val waktuPendaftaran: String,

	@field:SerializedName("perkiraan_waktu_tunggu")
	val perkiraanWaktuTunggu: String,
)