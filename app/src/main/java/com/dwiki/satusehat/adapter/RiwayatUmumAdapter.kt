package com.dwiki.satusehat.adapter

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.cardview.widget.CardView
import androidx.recyclerview.widget.RecyclerView
import com.dwiki.satusehat.R
import com.dwiki.satusehat.data.responseModel.DataRiwayatAntreanUmumItem
import com.dwiki.satusehat.util.VectorDrawableUtils
import com.github.vipulasri.timelineview.TimelineView

class RiwayatUmumAdapter(private val listUmum:List<DataRiwayatAntreanUmumItem>):RecyclerView.Adapter<RiwayatUmumAdapter.TimeLineViewHolder>() {

    private lateinit var mLayoutInflater: LayoutInflater

    private var onItemClickCallback: OnItemClickCallback? = null

    fun setOnItemClickCallback(onItemClickCallback: OnItemClickCallback){
        this.onItemClickCallback = onItemClickCallback
    }

    override fun getItemViewType(position: Int): Int {
        return TimelineView.getTimeLineViewType(position, itemCount)
    }

   inner class TimeLineViewHolder(itemView: View, viewType: Int):RecyclerView.ViewHolder(itemView) {
        val date = itemView.findViewById(R.id.text_timeline_date) as TextView
        val timeline = itemView.findViewById<TimelineView>(R.id.timeline)
        val rumahSakit = itemView.findViewById(R.id.tv_rumah_sakit) as TextView
        val cardRS = itemView.findViewById(R.id.cv_rumahsakit) as CardView

        init {
            timeline.initLine(viewType)
        }
    }


    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): RiwayatUmumAdapter.TimeLineViewHolder {
        if(!::mLayoutInflater.isInitialized) {
            mLayoutInflater = LayoutInflater.from(parent.context)
        }
        return TimeLineViewHolder(mLayoutInflater.inflate(R.layout.item_riwayat,parent,false),viewType)
    }

    override fun onBindViewHolder(holder: RiwayatUmumAdapter.TimeLineViewHolder, position: Int) {
        val timeLineModel = listUmum[position]

        setMarker(holder,R.drawable.ic_umum)

        if (timeLineModel.waktu.isNotEmpty()){
            holder.date.visibility = View.VISIBLE
            val date = timeLineModel.waktu.substring(0,10)
            holder.date.text = date
        } else {
            holder.date.visibility = View.GONE
        }

        holder.rumahSakit.text = timeLineModel.rumahSakitRumahSakit
        holder.cardRS.setOnClickListener {
            onItemClickCallback?.onItemClicked(timeLineModel)
        }
    }

    override fun getItemCount(): Int  = listUmum.size

    private fun setMarker(holder: RiwayatUmumAdapter.TimeLineViewHolder, drawableResId: Int) {
        holder.timeline.marker = VectorDrawableUtils.getDrawable(holder.itemView.context,drawableResId)
    }

    interface OnItemClickCallback{
        fun onItemClicked(listRiwayatUmum:DataRiwayatAntreanUmumItem)
    }
}