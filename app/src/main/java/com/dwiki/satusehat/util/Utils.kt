package com.dwiki.satusehat.util

import android.content.Context
import android.text.Editable
import android.view.View
import android.widget.Button
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast

object Utils {

    fun makeToast(context: Context,text:String){
        Toast.makeText(context,text,Toast.LENGTH_SHORT).show()
    }

    fun passLength(view: View, text:Editable?){
        if (text.toString().length < 6) view.visibility = View.VISIBLE else  view.visibility = View.INVISIBLE
    }

    fun confirmPass(view: View, editText1: EditText, editText: EditText){
        if (editText1.text.toString() != editText.text.toString()) view.visibility  = View.VISIBLE else view.visibility = View.INVISIBLE
    }

    fun counterText(textView: TextView, total: String, editable: Editable?){
      textView.text = editable.toString().length.toString() + total
    }

    fun checkPhoneNum(view: View,text: Editable?){
        if (text != null) {
            if (text.startsWith("0", true)) view.visibility = View.VISIBLE else view.visibility = View.GONE
        }
    }
    fun checkBPJS(view: View, text: Editable?){
        if(text.toString().length < 11) view.visibility = View.VISIBLE else view.visibility = View.GONE
    }

    fun wrongPass(view: TextView){
        view.visibility = View.VISIBLE
        view.text = "Password yang anda masukan salah"
    }

    fun nikNotFound(view: TextView){
        view.visibility = View.VISIBLE
        view.text = "NIK anda belum terdaftar"
    }

    fun correctPass(view: TextView){
        view.visibility = View.GONE
    }

    fun setSignEnabled(nik:Editable, password: Editable, button: Button,view: View){
        button.isEnabled = nik != null && password != null && password.toString().length >= 6 && view.visibility == View.GONE
    }

    fun setRegisterEnabled(nik:Editable, password1: Editable, password2:Editable, button: Button){
        button.isEnabled = nik != null && password1 != null && password1.toString().length >= 6 && password2.toString() == password1.toString()&&nik.length == 16
    }


}