package com.dwiki.satusehat.model

import android.os.Parcelable
import kotlinx.parcelize.Parcelize

@Parcelize
class RumahSakit(
    val id:Int,
    val  nama:String,
    val daerah:String,
    val foto:String? = null
):Parcelable