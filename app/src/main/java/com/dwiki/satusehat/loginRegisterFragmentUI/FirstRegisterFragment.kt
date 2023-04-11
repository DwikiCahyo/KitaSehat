package com.dwiki.satusehat.loginRegisterFragmentUI

import android.content.Intent
import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.navigation.Navigation
import androidx.navigation.fragment.findNavController
import com.dwiki.satusehat.R
import com.dwiki.satusehat.util.Utils
import com.dwiki.satusehat.databinding.FragmentFirstRegisterBinding
import com.dwiki.satusehat.ui.LoginActivity
import com.dwiki.satusehat.util.KeyboardUtils


class FirstRegisterFragment : Fragment() {

    private var _binding: FragmentFirstRegisterBinding? = null
    private val binding get() = _binding!!
    private val utils =  Utils

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        _binding = FragmentFirstRegisterBinding.inflate(inflater,container,false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        nikWatcher()
        passwordWatcher()
        passwordConfirm()
        Utils.setRegisterEnabled(binding.edtNik.text!!,
            binding.edtPassword.text!!, binding.edtConfirmPassword.text!!,binding.btnLanjut)


        binding.btnLanjut.setOnClickListener{
            val args = Bundle()
            KeyboardUtils.hideKeyboard(requireContext(),it)
            args.putString("nik",binding.edtNik.text.toString())
            args.putString("pass",binding.edtConfirmPassword.text.toString())
            findNavController().navigate(R.id.action_firstRegisterFragment_to_secondRegisterFragment,args)

        }


        binding.btnBackButtonCustom.setOnClickListener{
            val intent = Intent(requireContext(), LoginActivity::class.java)
            activity?.startActivity(intent)
        }

    }




    private fun nikWatcher() {

        binding.edtNik.addTextChangedListener(object : TextWatcher {

            private val CONTINUOUS_PATTERN = "(\\d)\\1{4,}"
            fun isContinuousDigits(nik: String): Boolean {
                return CONTINUOUS_PATTERN.toRegex().containsMatchIn(nik)
            }

            override fun beforeTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                //
            }

            override fun onTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                Utils.setRegisterEnabled(binding.edtNik.text!!,
                    binding.edtPassword.text!!, binding.edtConfirmPassword.text!!,binding.btnLanjut)
            }

            override fun afterTextChanged(p0: Editable?) {

                binding.tvCounter.visibility = View.VISIBLE
                utils.counterText(binding.tvCounter,"/16",p0)
            }

        })
    }

    private fun passwordWatcher() {
        binding.edtPassword.addTextChangedListener(object :TextWatcher{
            override fun beforeTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                //
            }

            override fun onTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                Utils.setRegisterEnabled(binding.edtNik.text!!,
                    binding.edtPassword.text!!, binding.edtConfirmPassword.text!!,binding.btnLanjut)
            }

            override fun afterTextChanged(p0: Editable?) {
                utils.passLength(binding.tvErrorFormatPass, p0)
            }

        })
    }

    private fun passwordConfirm(){
        binding.edtConfirmPassword.addTextChangedListener(object :TextWatcher{
            override fun beforeTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                //
            }

            override fun onTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                Utils.setRegisterEnabled(binding.edtNik.text!!,
                    binding.edtPassword.text!!, binding.edtConfirmPassword.text!!,binding.btnLanjut)
            }

            override fun afterTextChanged(p0: Editable?) {
                utils.confirmPass(binding.tvErrorDiffPass, binding.edtConfirmPassword,binding.edtPassword)
            }
        })
    }

}