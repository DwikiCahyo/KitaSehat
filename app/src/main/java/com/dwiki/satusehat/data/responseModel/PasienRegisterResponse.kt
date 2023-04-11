package com.dwiki.satusehat.data.responseModel

import com.google.gson.annotations.SerializedName

data class PasienRegisterResponse(

	@field:SerializedName("message")
	val message: String,

	@field:SerializedName("token")
	val token: String
)
