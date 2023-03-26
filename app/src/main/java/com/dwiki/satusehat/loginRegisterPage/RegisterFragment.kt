package com.dwiki.satusehat.loginRegisterPage

import android.app.DatePickerDialog
import android.content.Intent
import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import android.view.*
import androidx.fragment.app.Fragment
import android.widget.AdapterView
import android.widget.ArrayAdapter
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.MenuHost
import androidx.core.view.MenuProvider
import androidx.lifecycle.Lifecycle
import com.dwiki.satusehat.KeyboardUtils
import com.dwiki.satusehat.MainActivity2
import com.dwiki.satusehat.MainActivity2.Companion.AGAMA
import com.dwiki.satusehat.MainActivity2.Companion.DOB
import com.dwiki.satusehat.MainActivity2.Companion.NIK
import com.dwiki.satusehat.MainActivity2.Companion.PASS1
import com.dwiki.satusehat.MainActivity2.Companion.PASS2
import com.dwiki.satusehat.MainActivity2.Companion.PEKERJAAN
import com.dwiki.satusehat.MainActivity2.Companion.PENDIDIKAN
import com.dwiki.satusehat.MainActivity2.Companion.PERKAWINAN
import com.dwiki.satusehat.R
import com.dwiki.satusehat.Utils
import com.dwiki.satusehat.databinding.FragmentRegisterBinding
import java.util.Calendar

class RegisterFragment : Fragment() {

    private var _binding:FragmentRegisterBinding? = null
    private val binding get() = _binding!!

    private val keyboardUtils = KeyboardUtils
    private val utils =  Utils
    private lateinit var pekerjaan:String
    private lateinit var agama:String
    private lateinit var perkawinan:String
    private lateinit var pendidikan:String
    private lateinit var tanggalLahir:String


    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        _binding = FragmentRegisterBinding.inflate(inflater, container, false)
        return binding.root
        return view

    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)



         val hintAgama = resources.getStringArray(R.array.agama)
         val hintPekerjaan = resources.getStringArray(R.array.pekerjaan)
         val hintPerkawinan = resources.getStringArray(R.array.status_perkawinan)
         val hintPendidikan = resources.getStringArray(R.array.pendidikan)

        val menuHost: MenuHost = requireActivity()
        menuHost.addMenuProvider(object : MenuProvider {
            override fun onCreateMenu(menu: Menu, menuInflater: MenuInflater) {
                menuInflater.inflate(R.menu.top_app_bar,menu)
            }

            override fun onMenuItemSelected(menuItem: MenuItem): Boolean {
                return when (menuItem.itemId){
                    //add custom dialog
                    R.id.btn_information -> {
                        utils.makeToast(context as AppCompatActivity, "Information")
                        true
                    }
                    else -> false
                }
            }

        }, viewLifecycleOwner, Lifecycle.State.RESUMED)


        setupAppBar()
        nikWatcher()
        passwordWatcher()
        passwordConfirm()
        formPekerjaan(hintPekerjaan)
        formAgama(hintAgama)
        formPerkawinan(hintPerkawinan)
        formPendidikan(hintPendidikan)
        setDatePicker()
        nextPage()

    }

    private fun setupKeyboard(view: View) {
        keyboardUtils.hideKeyboard(context as AppCompatActivity, view)
    }

    private fun nextPage() {
        binding.btnSimpanData.setOnClickListener {
            val nama = binding.edtNik.text.toString()
            val pass1 = binding.edtPassword.text.toString()
            val pass2 = binding.edtConfirmPassword.text.toString()

            val intent = Intent(activity, MainActivity2::class.java)
            intent.putExtra(NIK, nama)
            intent.putExtra(PASS1, pass1)
            intent.putExtra(PASS2, pass2)
            intent.putExtra(PENDIDIKAN, pendidikan)
            intent.putExtra(AGAMA, agama)
            intent.putExtra(PERKAWINAN, perkawinan)
            intent.putExtra(DOB, tanggalLahir)
            intent.putExtra(PEKERJAAN, pekerjaan)
            startActivity(intent)
        }
    }

    private fun setupAppBar() {

        val toolbar = binding.topAppBar
        (activity as AppCompatActivity).setSupportActionBar(toolbar)
        (activity as AppCompatActivity).supportActionBar?.setDisplayShowTitleEnabled(false)
        (activity as AppCompatActivity).supportActionBar?.setDisplayShowHomeEnabled(true)
        (activity as AppCompatActivity).supportActionBar?.setDisplayHomeAsUpEnabled(true)

    }

    private fun nikWatcher() {
        binding.edtNik.addTextChangedListener(object : TextWatcher {
            override fun beforeTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                //
            }

            override fun onTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
//
            }

            override fun afterTextChanged(p0: Editable?) {
                binding.tvCounter.visibility = View.VISIBLE
                // test edittext
//                if (!p0.toString().startsWith("08", true)) binding.tvErrorFormatNum.visibility = View.VISIBLE else binding.tvErrorFormatNum.visibility = View.GONE
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
                //
            }

            override fun afterTextChanged(p0: Editable?) {
                utils.confirmPass(binding.tvErrorDiffPass, binding.edtConfirmPassword,binding.edtPassword)
            }
        })
    }



    private fun setDatePicker() {
      binding.edtTanggalLahir.setOnClickListener{
          val calendar = Calendar.getInstance()

          val year = calendar.get(Calendar.YEAR)
          val month = calendar.get(Calendar.MONTH)
          val day = calendar.get(Calendar.DAY_OF_MONTH)

          val datePickerDialog = DatePickerDialog(requireContext(),
              { _, year, month, dayOfMonth ->
                 tanggalLahir = "$dayOfMonth/${month + 1}/$year"
                  binding.edtTanggalLahir.setText(tanggalLahir)
              },
                  year, month, day,
          )
          datePickerDialog.show()
          setupKeyboard(binding.edtTanggalLahir)

      }
    }

    private fun formPendidikan(hintPendidikan: Array<String>) {
        binding.edtPendidikan.apply {
            val adapterPendidikan = ArrayAdapter(requireContext(),R.layout.dropdown_item,hintPendidikan)
            setAdapter(adapterPendidikan)
            setText(context.getString(R.string.str_pilih_pendidikan),false)
            onItemClickListener = AdapterView.OnItemClickListener{
                    _, _, position, _ ->
                utils.makeToast(requireContext(), hintPendidikan[position])
                pendidikan = adapterPendidikan.getItem(position).toString()
                setupKeyboard(binding.edtPendidikan)
            }
        }
    }

    private fun formPerkawinan(hintPerkawinan: Array<String>) {
        binding.edtPerkawinan.apply {
            val adapterPerkawinan = ArrayAdapter(requireContext(),R.layout.dropdown_item,hintPerkawinan)
            setAdapter(adapterPerkawinan)
            setText(context.getString(R.string.str_status_perkawinan),false)
            onItemClickListener = AdapterView.OnItemClickListener { _, _, position, _ ->
                utils.makeToast(requireContext(), hintPerkawinan[position])
                perkawinan = adapterPerkawinan.getItem(position).toString()
                setupKeyboard(binding.edtPerkawinan)
            }
        }
    }

    private fun formAgama(hintAgama: Array<String>) {
        binding.edtAgama.apply {
            val adapterAgama = ArrayAdapter(requireContext(),R.layout.dropdown_item,hintAgama)
            setAdapter(adapterAgama)
            setText(context.getString(R.string.str_pilih_agama),false)
            onItemClickListener = AdapterView.OnItemClickListener { _, _, position, _ ->
                utils.makeToast(requireContext(), hintAgama[position])
                agama = adapterAgama.getItem(position).toString()
                setupKeyboard(binding.edtAgama)
            }
        }
    }


    private fun formPekerjaan(hintPekerjaan: Array<String>) {

        binding.edtPekerjaan.apply {
            val adapterPekerjaan = ArrayAdapter(requireContext(), R.layout.dropdown_item, hintPekerjaan)
            setAdapter(adapterPekerjaan)
            setText(context.getString(R.string.str_pilih_pekerjaan), false)
            onItemClickListener = AdapterView.OnItemClickListener { _, _, position, _ ->
                utils.makeToast(requireContext(), hintPekerjaan[position])
                pekerjaan = adapterPekerjaan.getItem(position).toString()
                setupKeyboard(binding.edtPekerjaan)
            }
        }
    }



    override fun onDestroy() {
        super.onDestroy()
        _binding = null
    }

}