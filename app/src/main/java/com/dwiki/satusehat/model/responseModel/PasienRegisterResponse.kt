package com.dwiki.satusehat.model.responseModel

import com.google.gson.annotations.SerializedName

data class PasienRegisterResponse(

	@field:SerializedName("message")
	val message: String,

	@field:SerializedName("token")
	val token: String
)
