package com.dwiki.satusehat.view.dialog

import android.app.AlertDialog
import android.app.Dialog
import android.os.Bundle
import androidx.fragment.app.DialogFragment
import com.dwiki.satusehat.databinding.DialogAlreadyRegisterBinding

class DialogAlreadyRegister(private val mssg:String):DialogFragment() {

    private lateinit var binding:DialogAlreadyRegisterBinding

    override fun onCreateDialog(savedInstanceState: Bundle?): Dialog {

        binding = DialogAlreadyRegisterBinding.inflate(layoutInflater)

        val builder = AlertDialog.Builder(requireActivity())
        builder.setView(binding.root)

        binding.tvHeader.text = mssg
        val dialog = builder.create()
        dialog.window?.setBackgroundDrawableResource(android.R.color.transparent)
        dialog.setCancelable(true)
        dialog.setCanceledOnTouchOutside(true)
        return dialog
    }
}