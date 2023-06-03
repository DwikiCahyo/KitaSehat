package com.dwiki.satusehat.ui.dialog

import android.app.AlertDialog
import android.app.Dialog
import android.os.Bundle
import androidx.fragment.app.DialogFragment

class DialogDetailRumahSakit(
    val test:String
    ):DialogFragment() {

    override fun onCreateDialog(savedInstanceState: Bundle?): Dialog =
        AlertDialog.Builder(requireContext())
            .setMessage(test)
            .setPositiveButton("Yes") { _,_ -> }
            .create()

    }