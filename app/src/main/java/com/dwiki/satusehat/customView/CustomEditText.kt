package com.dwiki.satusehat.customView

import android.content.Context
import android.graphics.Canvas
import android.util.AttributeSet
import android.view.View
import androidx.annotation.ColorInt
import androidx.appcompat.widget.AppCompatAutoCompleteTextView
import androidx.appcompat.widget.AppCompatEditText
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R

class CustomEditText:AppCompatEditText {

    private  var hintColorInt:Int? = null

    constructor(context: Context) : super(context) {init()}
    constructor(context: Context, attrs: AttributeSet) : super(context, attrs){init()}
    constructor(context: Context, attrs: AttributeSet, defStyleAttr: Int) : super(context, attrs, defStyleAttr){init()}

    private fun init(){
        hintColorInt = ContextCompat.getColor(context, R.color.gray_light)
    }

    override fun onDraw(canvas: Canvas?) {
        super.onDraw(canvas)
        setBackgroundResource(R.drawable.custom_border_edit_text)
        textAlignment = View.TEXT_ALIGNMENT_VIEW_START
        textSize = 16f
    }


}

