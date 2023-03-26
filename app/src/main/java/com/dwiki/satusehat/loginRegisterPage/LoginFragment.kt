package com.dwiki.satusehat.loginRegisterPage

import android.content.Intent
import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.navigation.Navigation
import com.dwiki.satusehat.MainActivity2
import com.dwiki.satusehat.MainActivity2.Companion.DATA
import com.dwiki.satusehat.R
import com.dwiki.satusehat.Utils
import com.dwiki.satusehat.databinding.FragmentLoginBinding

class LoginFragment : Fragment() {

    private val utils = Utils
    private var _binding: FragmentLoginBinding? = null
    private val binding get() = _binding!!

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        _binding = FragmentLoginBinding.inflate(inflater, container, false)
        return binding.root
        return view

    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        nikWatcher()
        passwordWatcher()
        setSignInEnabled()
        binding.btnTvDaftar.setOnClickListener (Navigation.createNavigateOnClickListener(R.id.action_loginFragment_to_registerFragment))
        binding.btnBackButtonCustom.setOnClickListener(Navigation.createNavigateOnClickListener(R.id.action_loginFragment_to_firstPageFragment2))

        binding.btnMasuk.setOnClickListener{
            val intent = Intent(activity,MainActivity2::class.java)
            intent.putExtra(DATA,"HOME PAGE SATU SEHAT")
            activity?.startActivity(intent)
        }
    }

    private fun setSignInEnabled() {
        val phoneNumber = binding.edtNik.text
        val password = binding.edtPassword.text
        binding.btnMasuk.isEnabled = phoneNumber != null && password != null && password.toString().length >= 6

    }

    private fun passwordWatcher() {
        binding.edtPassword.addTextChangedListener(object :TextWatcher{
            override fun beforeTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                //
            }

            override fun onTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                setSignInEnabled()
            }

            override fun afterTextChanged(p0: Editable?) {
               utils.passLength(binding.tvErrorFormatPass,p0)
            }

        })
    }

    private fun nikWatcher() {
        binding.edtNik.addTextChangedListener(object : TextWatcher {
            override fun beforeTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                //
            }

            override fun onTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
//                if (p0.toString().length < 16) binding.tvErrorFormatNum.visibility = View.VISIBLE else binding.tvErrorFormatNum.visibility = View.GONE
                setSignInEnabled()
            }

            override fun afterTextChanged(p0: Editable?) {
                binding.tvCounter.visibility = View.VISIBLE
                // test edittext
//                if (!p0.toString().startsWith("08", true)) binding.tvErrorFormatNum.visibility = View.VISIBLE else binding.tvErrorFormatNum.visibility = View.GONE
                utils.counterText(binding.tvCounter,"/16",p0)
            }

        })
    }

    override fun onDestroy() {
        super.onDestroy()
        _binding = null
    }
}
