package com.dwiki.satusehat.customView

import android.content.Context
import android.graphics.Canvas
import android.graphics.drawable.Drawable
import android.util.AttributeSet
import android.view.DragAndDropPermissions
import android.view.Gravity
import androidx.appcompat.widget.AppCompatButton
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R

class CustomButton:AppCompatButton {

    private var txtColor: Int? = null
    private lateinit var enabled: Drawable
    private lateinit var disabled: Drawable

    constructor(context: Context) : super(context) {
        init()
    }
    constructor(context: Context, attrs: AttributeSet) : super(context, attrs) {
        init()
    }
    constructor(context: Context, attrs: AttributeSet, defStyleAttr: Int) : super(context, attrs, defStyleAttr) {
        init()
    }

    override fun onDraw(canvas: Canvas?) {
        super.onDraw(canvas)
        txtColor?.let { setTextColor(it) }
        background = if (isEnabled) enabled else disabled
        textSize = 15f
        width = 331
        height = 56

    }

    private fun init(){
        txtColor = ContextCompat.getColor(context,R.color.white)
        enabled = ContextCompat.getDrawable(context,R.drawable.custom_button_enable) as Drawable
        disabled = ContextCompat.getDrawable(context,R.drawable.custom_button_disable) as Drawable
    }

}