package com.dwiki.satusehat.ui

import android.app.AlertDialog
import android.app.Dialog
import android.content.DialogInterface
import android.content.Intent
import android.graphics.Color
import android.graphics.drawable.ColorDrawable
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import androidx.fragment.app.DialogFragment
import com.dwiki.satusehat.databinding.DialogRegisterBinding

class RegisterDialog:DialogFragment() {

    private lateinit var binding:DialogRegisterBinding

    override fun onCreateDialog(savedInstanceState: Bundle?): Dialog {
        binding = DialogRegisterBinding.inflate(LayoutInflater.from(context))

        val builder = AlertDialog.Builder(requireActivity())
        builder.setView(binding.root)

        binding.checkboxTest.setOnCheckedChangeListener { buttonView, isChecked ->
            if (isChecked){
                binding.btnLanjut.visibility = View.VISIBLE
            } else {
                binding.btnLanjut.visibility = View.GONE
            }
        }

        binding.btnLanjut.setOnClickListener {
            val intent = Intent(context, RegisterActivity::class.java)
            startActivity(intent)
            dismiss()

        }
        val dialog = builder.create()
        dialog.window?.setBackgroundDrawable(ColorDrawable(Color.TRANSPARENT))
        return dialog

    }

}