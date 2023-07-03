package com.dwiki.satusehat.view.dialog

import android.app.AlertDialog
import android.app.Dialog
import android.content.Intent
import android.os.Bundle
import androidx.fragment.app.DialogFragment
import com.dwiki.satusehat.databinding.DialogSuccesBinding
import com.dwiki.satusehat.view.DashboardActivity

class SuccessDialog(
    val mssg:String
):DialogFragment() {

    private lateinit var binding:DialogSuccesBinding

    override fun onCreateDialog(savedInstanceState: Bundle?): Dialog {
//        return super.onCreateDialog(savedInstanceState)
        binding = DialogSuccesBinding.inflate(layoutInflater)

        val builder = AlertDialog.Builder(requireActivity())
        builder.setView(binding.root)

        binding.tvTextDialog.text = mssg

        binding.btnLanjut.setOnClickListener {
            val intent = Intent(context, DashboardActivity::class.java)
            startActivity(intent)
            dismiss()
        }

        val dialog = builder.create()
        dialog.window?.setBackgroundDrawableResource(android.R.color.transparent)
        return dialog

    }
}