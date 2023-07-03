package com.dwiki.satusehat.customView

import android.content.Context
import android.graphics.Canvas
import android.graphics.drawable.Drawable
import android.text.Editable
import android.text.TextWatcher
import android.util.AttributeSet
import android.view.View
import androidx.appcompat.widget.AppCompatEditText
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R

class CustomEditNik:AppCompatEditText {

    private lateinit var successDrawable:Drawable
    private lateinit var errorDrawable: Drawable
    private var hintColor:Int? = null

    constructor(context: Context) : super(context) {init()}
    constructor(context: Context, attrs: AttributeSet) : super(context, attrs){init()}
    constructor(context: Context, attrs: AttributeSet, defStyleAttr: Int) : super(context, attrs, defStyleAttr){init()}

    private fun init(){
        successDrawable = ContextCompat.getDrawable(context,R.drawable.success_check_edit_text) as Drawable
        errorDrawable = ContextCompat.getDrawable(context,R.drawable.error_check_edit_text) as Drawable
        hintColor = ContextCompat.getColor(context,R.color.gray_light)
        addTextChangedListener(object :TextWatcher{
            override fun beforeTextChanged(s: CharSequence?, start: Int, count: Int, after: Int) {}
            override fun onTextChanged(s: CharSequence?, start: Int, before: Int, count: Int) {
                if (s.toString().isNullOrEmpty()) {
                    showError()
                }

            }
            override fun afterTextChanged(s: Editable?) {
                if (s.toString().length ==16 && s.toString().isNotEmpty())  showSuccess()
            }

        })
    }

    private fun showSuccess(){
        setButtonDrawables(endOfTheText = successDrawable)
    }
    private fun showError(){
        error = "NIK tidak boleh kosong"
//        setButtonDrawables(endOfTheText = errorDrawable)
    }



    override fun onDraw(canvas: Canvas?) {
        super.onDraw(canvas)
        setBackgroundResource(R.drawable.custom_border_edit_text)
        textAlignment = View.TEXT_ALIGNMENT_VIEW_START
        hint = context.getString(R.string.str_nik)
        textSize = 16f
    }

    private fun setButtonDrawables(
        startOfTheText: Drawable? = null,
        topOfTheText:Drawable? = null,
        endOfTheText:Drawable? = null,
        bottomOfTheText: Drawable? = null
    ){
        setCompoundDrawablesWithIntrinsicBounds(
            startOfTheText,
            topOfTheText,
            endOfTheText,
            bottomOfTheText
        )
    }

}