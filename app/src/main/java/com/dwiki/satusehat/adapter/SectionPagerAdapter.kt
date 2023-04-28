package com.dwiki.satusehat.adapter

import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import androidx.viewpager2.adapter.FragmentStateAdapter
import com.dwiki.satusehat.ui.pendaftaran.PendaftaranBpjsFragment
import com.dwiki.satusehat.ui.pendaftaran.PendaftaranUmumFragment

class SectionPagerAdapter(activity:AppCompatActivity):FragmentStateAdapter(activity) {
    override fun getItemCount(): Int {
       return 2
    }

    override fun createFragment(position: Int): Fragment {
        var fragment:Fragment? =null
        when(position){
            0 -> fragment = PendaftaranBpjsFragment()
            1 -> fragment = PendaftaranUmumFragment()
        }
        return fragment as Fragment
    }
}