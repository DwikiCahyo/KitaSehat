package com.dwiki.satusehat

import android.content.Context
import android.text.Editable
import android.view.View
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


}