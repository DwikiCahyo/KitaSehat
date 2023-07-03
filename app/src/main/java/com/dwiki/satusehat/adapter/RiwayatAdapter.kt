package com.dwiki.satusehat.adapter

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.cardview.widget.CardView
import androidx.core.content.ContextCompat
import androidx.recyclerview.widget.RecyclerView
import com.dwiki.satusehat.R
import com.dwiki.satusehat.model.responseModel.DataRiwayatAntreanBpjsItem
import com.dwiki.satusehat.model.responseModel.DataRiwayatAntreanUmumItem
import com.dwiki.satusehat.util.VectorDrawableUtils
import com.github.vipulasri.timelineview.TimelineView

class RiwayatAdapter(private val list:List<DataRiwayatAntreanBpjsItem>):RecyclerView.Adapter<RiwayatAdapter.TimeLineViewHolder>() {

    private lateinit var mLayoutInflater: LayoutInflater
    private var onItemClickCallback:OnItemClickCallback? = null

    fun setOnItemClickCallback(onItemClickCallback: OnItemClickCallback){
        this.onItemClickCallback = onItemClickCallback
    }


    override fun getItemViewType(position: Int): Int {
        return TimelineView.getTimeLineViewType(position, itemCount)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): TimeLineViewHolder {
        if(!::mLayoutInflater.isInitialized) {
            mLayoutInflater = LayoutInflater.from(parent.context)
        }

        return TimeLineViewHolder(mLayoutInflater.inflate(R.layout.item_riwayat,parent,false),viewType)
    }

    override fun getItemCount(): Int  = list.size

    private fun setMarker(holder: TimeLineViewHolder, drawableResId: Int) {
        holder.timeline.marker = VectorDrawableUtils.getDrawable(holder.itemView.context,drawableResId)
    }

    override fun onBindViewHolder(holder: TimeLineViewHolder, position: Int) {
        val timeLineModel = list[position]


        setMarker(holder,R.drawable.ic_bpjs)

        if (timeLineModel.waktu.isNotEmpty()){
            holder.date.visibility = View.VISIBLE
            val date = timeLineModel.waktu.substring(0,10)
            holder.date.text = date
        } else {
            holder.date.visibility = View.GONE
        }

        holder.rumahSakit.text = timeLineModel.rumahSakitRumahSakit
        holder.cardRs.setOnClickListener {
            onItemClickCallback?.onItemClicked(timeLineModel)
        }

    }

    inner class TimeLineViewHolder(itemView:View,viewType: Int):RecyclerView.ViewHolder(itemView) {
        val date = itemView.findViewById(R.id.text_timeline_date) as TextView
        val timeline = itemView.findViewById<TimelineView>(R.id.timeline)
        val rumahSakit = itemView.findViewById(R.id.tv_rumah_sakit) as TextView
        val cardRs = itemView.findViewById(R.id.cv_rumahsakit) as CardView

        init {
            timeline.initLine(viewType)
        }
    }

    interface OnItemClickCallback{
        fun onItemClicked(listRiwayatBpjs: DataRiwayatAntreanBpjsItem)
    }
}