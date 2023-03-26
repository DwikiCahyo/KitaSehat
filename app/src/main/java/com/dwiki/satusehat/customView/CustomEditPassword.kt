package com.dwiki.satusehat.customView

import android.content.Context
import android.graphics.Canvas
import android.graphics.drawable.Drawable
import android.text.Editable
import android.text.TextWatcher
import android.text.method.HideReturnsTransformationMethod
import android.text.method.PasswordTransformationMethod
import android.util.AttributeSet
import android.view.MotionEvent
import android.view.View
import androidx.appcompat.widget.AppCompatEditText
import androidx.core.content.ContextCompat
import com.dwiki.satusehat.R

class CustomEditPassword:AppCompatEditText, View.OnTouchListener {
    private lateinit var hiddenPassword:Drawable


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
        showPassword()
        setBackgroundResource(R.drawable.custom_border_edit_text)
        textAlignment = View.TEXT_ALIGNMENT_VIEW_START
//        setHint(R.string.str_password)
        textSize = 16f
    }

    private fun init(){
        hiddenPassword = ContextCompat.getDrawable(context,R.drawable.hide_pass) as Drawable
//        textChangeListener()
        setOnTouchListener(this)
    }

    private fun textChangeListener() {
        addTextChangedListener(object : TextWatcher {
            override fun beforeTextChanged(s: CharSequence, start: Int, count: Int, after: Int) {
                // Do nothing.
            }

            override fun onTextChanged(s: CharSequence, start: Int, before: Int, count: Int) {
                //Do nothing
            }

            override fun afterTextChanged(s: Editable) {
             //
            }
        })
    }

    private fun showPassword(){
        setButtonDrawables(endOfTheText = hiddenPassword)
    }
    private fun  hidePassword(){
        setButtonDrawables()
    }

    private fun setButtonDrawables(
        startOfTheText: Drawable? = null,
        topOfTheText: Drawable? = null,
        endOfTheText: Drawable? = null,
        bottomOfTheText: Drawable? = null
    ){
        setCompoundDrawablesWithIntrinsicBounds(
            startOfTheText,
            topOfTheText,
            endOfTheText,
            bottomOfTheText
        )
    }

    override fun onTouch(v: View?, event: MotionEvent): Boolean {
        if (compoundDrawables[2] != null) {
            val eyeButtonStart: Float
            val eyeButtonEnd: Float
            var isEyeButtonClicked = false

            if (layoutDirection == View.LAYOUT_DIRECTION_RTL) {
                eyeButtonEnd = (hiddenPassword.intrinsicWidth + paddingStart).toFloat()
                if (event.x < eyeButtonEnd) isEyeButtonClicked = true
            } else {
                eyeButtonStart = (width - paddingEnd - hiddenPassword.intrinsicWidth).toFloat()
                if (event.x > eyeButtonStart) isEyeButtonClicked = true
            }

            if (isEyeButtonClicked) {
                return when (event.action) {
                    MotionEvent.ACTION_DOWN -> {
                        hidePassword()
                        if (transformationMethod.equals(HideReturnsTransformationMethod.getInstance())) {
                            transformationMethod = PasswordTransformationMethod.getInstance()
                            hiddenPassword = ContextCompat.getDrawable(context, R.drawable.hide_pass) as Drawable
                           showPassword()
                        } else {
                            transformationMethod = HideReturnsTransformationMethod.getInstance()
                            hiddenPassword = ContextCompat.getDrawable(context, R.drawable.show_pass) as Drawable
                            showPassword()
                        }
                        true
                    }
                    else -> false
                }
            } else return false
        }
        return false
    }
}