package com.dwiki.satusehat.util

import android.content.ContentResolver
import android.content.Context
import android.graphics.Bitmap
import android.graphics.BitmapFactory
import android.net.Uri
import android.os.Environment
import android.text.Editable
import android.view.View
import android.widget.Button
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast
import java.io.*
import java.text.SimpleDateFormat
import java.util.*

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

    private const val FILENAME_FORMAT = "dd-MMM-yyyy"

    private val timeStamp: String = SimpleDateFormat(
        FILENAME_FORMAT,
        Locale.US
    ).format(System.currentTimeMillis())

    fun createTempFile(context: Context): File {
        val storageDir: File? = context.getExternalFilesDir(Environment.DIRECTORY_PICTURES)
        return File.createTempFile(timeStamp, ".jpg", storageDir)
    }

    fun uriToFile(selectedImg: Uri, context: Context): File {
        val contentResolver: ContentResolver = context.contentResolver
        val myFile = Utils.createTempFile(context)

        val inputStream = contentResolver.openInputStream(selectedImg) as InputStream
        val outputStream: OutputStream = FileOutputStream(myFile)
        val buf = ByteArray(1024)
        var len: Int

        while (inputStream.read(buf).also { len = it } > 0) outputStream.write(buf, 0, len)
        outputStream.close()
        inputStream.close()

        return myFile
    }


    fun reduceFileImage(file: File): File {
        val bitmap = BitmapFactory.decodeFile(file.path)
        var compressQuality = 100
        var streamLength: Int
        do {
            val bmpStream = ByteArrayOutputStream()
            bitmap.compress(Bitmap.CompressFormat.JPEG, compressQuality, bmpStream)
            val bmpPicByteArray = bmpStream.toByteArray()
            streamLength = bmpPicByteArray.size
            compressQuality -= 5
        } while (streamLength > 1000000)
        bitmap.compress(Bitmap.CompressFormat.JPEG, compressQuality, FileOutputStream(file))
        return file
    }

}