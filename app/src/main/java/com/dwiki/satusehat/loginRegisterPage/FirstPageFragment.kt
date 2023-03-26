package com.dwiki.satusehat.loginRegisterPage

import android.os.Bundle
import android.os.Handler
import android.text.Html
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.appcompat.app.AppCompatActivity
import androidx.core.content.ContextCompat
import androidx.navigation.Navigation
import androidx.viewpager2.widget.CompositePageTransformer
import androidx.viewpager2.widget.MarginPageTransformer
import androidx.viewpager2.widget.ViewPager2
import com.dwiki.satusehat.R
import com.dwiki.satusehat.adapter.onboardingAdapter
import com.dwiki.satusehat.databinding.FragmentFirstPageBinding
import com.dwiki.satusehat.model.Onboard
import kotlin.math.abs

class FirstPageFragment : Fragment() {

    private var _binding:FragmentFirstPageBinding? = null
    private val binding get() = _binding!!
    private lateinit var handler : Handler
    private lateinit var adapter: onboardingAdapter
    private lateinit var onboardList: ArrayList<Onboard>
    private lateinit var dots: ArrayList<TextView>

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        _binding = FragmentFirstPageBinding.inflate(inflater,container,false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        loadData()
        setUpTransformer()
        binding.btnLanjut.setOnClickListener(
            Navigation.createNavigateOnClickListener(R.id.action_firstPageFragment_to_loginFragment)

        )
        dots = ArrayList()
        setIndicator()
        binding.viewPager.registerOnPageChangeCallback(object : ViewPager2.OnPageChangeCallback(){
            override fun onPageSelected(position: Int) {
                super.onPageSelected(position)
                selectedDot(position)
            }
        })
    }

    private fun selectedDot(position: Int) {
       for (i in 0 until onboardList.size){
           if (i == position){
               dots[i].setTextColor(ContextCompat.getColor(requireContext(),R.color.primary))
           }else{
               dots[i].setTextColor(ContextCompat.getColor(requireContext(),R.color.gray_light))
           }
       }
    }

    private fun setIndicator() {
        for (i in 0 until onboardList.size){
            dots.add(TextView(this.requireContext()))
            dots[i].text = Html.fromHtml("&#9679",Html.FROM_HTML_MODE_LEGACY).toString()
            dots[i].textSize = 20f
            binding.dotIndicator.addView(dots[i])
        }
    }


    private fun setUpTransformer() {
        val transformer = CompositePageTransformer()
        transformer.addTransformer(MarginPageTransformer(20))
        transformer.addTransformer{page,position ->
            val r = 1 - abs(position)
            page.scaleY = 0.85f + r * 0.14f
        }
        binding.viewPager.setPageTransformer(transformer)
    }


    override fun onDestroy() {
        super.onDestroy()
        _binding = null
    }


    private fun loadData(){
        onboardList = ArrayList()
        onboardList.add(Onboard(R.drawable.health_image,"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type."))
        onboardList.add(Onboard(R.drawable.healthcare,"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type."))
        onboardList.add(Onboard(R.drawable.insurance,"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type."))
        adapter = onboardingAdapter(onboardList,binding.viewPager)
        binding.viewPager.adapter = adapter
    }



}