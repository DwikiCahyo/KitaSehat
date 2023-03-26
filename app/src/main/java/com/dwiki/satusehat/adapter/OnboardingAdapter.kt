package com.dwiki.satusehat.adapter

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import androidx.viewpager2.widget.ViewPager2
import com.dwiki.satusehat.R
import com.dwiki.satusehat.model.Onboard

class onboardingAdapter(private val onboardingList:ArrayList<Onboard>,private val viewPager2: ViewPager2):RecyclerView.Adapter<onboardingAdapter.OnboardingViewHolder>() {

    class OnboardingViewHolder(itemView: View):RecyclerView.ViewHolder(itemView) {
        val imageView:ImageView = itemView.findViewById(R.id.iv_onboarding)
        val desc:TextView = itemView.findViewById(R.id.tv_desc_onboarding)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): OnboardingViewHolder {
       val view = LayoutInflater.from(parent.context).inflate(R.layout.card_item_onboarding,parent,false)
        return OnboardingViewHolder(view)
    }

    override fun onBindViewHolder(holder: OnboardingViewHolder, position: Int) {
        val onboarding = onboardingList[position]
        holder.imageView.setImageResource(onboarding.image)
        holder.desc.text = onboarding.description

    }

    override fun getItemCount(): Int {
        return onboardingList.size
    }

}