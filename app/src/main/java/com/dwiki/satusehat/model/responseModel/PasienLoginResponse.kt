package com.dwiki.satusehat.model.responseModel

import com.google.gson.annotations.SerializedName

data class PasienLoginResponse(

	@field:SerializedName("message")
	val message: String,

	@field:SerializedName("token")
	val token: String
)
