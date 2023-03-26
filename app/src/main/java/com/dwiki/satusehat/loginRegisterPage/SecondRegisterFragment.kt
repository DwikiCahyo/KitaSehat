package com.dwiki.satusehat.loginRegisterPage

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.FragmentFirstRegisterBinding
import com.dwiki.satusehat.databinding.FragmentSecondRegisterBinding

class SecondRegisterFragment : Fragment() {

    private var _binding: FragmentSecondRegisterBinding? = null
    private val binding get() = _binding!!

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        _binding = FragmentSecondRegisterBinding.inflate(inflater,container,false)
        return binding.root
    }

}