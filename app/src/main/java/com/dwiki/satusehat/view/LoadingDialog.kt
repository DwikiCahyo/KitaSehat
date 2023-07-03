package com.dwiki.satusehat.view

import android.app.Dialog
import android.content.Context
import android.graphics.Color
import android.graphics.drawable.ColorDrawable
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R
import com.github.ybq.android.spinkit.SpinKitView
import com.github.ybq.android.spinkit.style.FoldingCube

class LoadingDialog(private val context: Context) {

    private var dialog:Dialog? = null

    fun startLoading(){

        dialog = Dialog(context)
        dialog?.setContentView(R.layout.dialog_spin_loading)

        val spinKitView = dialog?.findViewById<SpinKitView>(R.id.layout_spinkit)
        FoldingCube().apply {
            ContextCompat.getColor(context,R.color.primary)
            spinKitView?.setIndeterminateDrawable(this)
        }

        dialog?.window?.setBackgroundDrawable(ColorDrawable(Color.TRANSPARENT))
        dialog?.setCancelable(false)
        dialog?.setCanceledOnTouchOutside(false)
        dialog?.show()
    }

    fun dismissDialog(){
        dialog?.dismiss()
    }




}