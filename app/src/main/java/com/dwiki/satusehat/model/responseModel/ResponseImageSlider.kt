package com.dwiki.satusehat.model.responseModel

import com.google.gson.annotations.SerializedName

data class ResponseImageSlider(

	@field:SerializedName("list_image_slider")
	val listImageSlider: List<ListImageSliderItem>,

	@field:SerializedName("message")
	val message: String
)

data class ListImageSliderItem(

	@field:SerializedName("image_link")
	val imageLink: String,

	@field:SerializedName("id")
	val id: Int
)
